// Copyright (c) 2005 Thomas Fuchs (http://script.aculo.us, http://mir.aculo.us)
// 
// See scriptaculous.js for full license.

/*--------------------------------------------------------------------------*/

var Droppables = {
  drops: [],

  remove: function(element) {
    this.drops = this.drops.reject(function(d) { return d.element==$(element) });
  },

  add: function(element) {
    element = $(element);
    var options = Object.extend({
      greedy:     true,
      hoverclass: null  
    }, arguments[1] || {});

    // cache containers
    if(options.containment) {
      options._containers = [];
      var containment = options.containment;
      if((typeof containment == 'object') && 
        (containment.constructor == Array)) {
        containment.each( function(c) { options._containers.push($(c)) });
      } else {
        options._containers.push($(containment));
      }
    }
    
    if(options.accept) options.accept = [options.accept].flatten();

    // Element.makePositioned(element); // fix IE
    options.element = element;

    this.drops.push(options);
  },

  isContained: function(element, drop) {
    var parentNode = element.parentNode;
    return drop._containers.detect(function(c) { return parentNode == c });
  },

  isAffected: function(pX, pY, element, drop) {
    // fetch updated element parameters if possible
    if ( drop.element.id )
      freshElement = $(drop.element.id);
    else
      freshElement = drop.element;
	
    return (
      (drop.element!=element) && (freshElement.parentNode) && 
      ((!drop._containers) ||
        this.isContained(element, drop)) &&
      ((!drop.accept) ||
        (Element.classNames(element).detect( 
          function(v) { return drop.accept.include(v) } ) )) &&
		((!drop.checkDroppableIsntContained) || !Element.contains(element, drop.element)) &&
      Position.within(freshElement, pX, pY) );
  },

  deactivate: function(drop) {
    if(drop.hoverclass)
      Element.removeClassName(drop.element, drop.hoverclass);
    this.last_active = null;
  },

  activate: function(drop) {
    if(this.last_active) this.deactivate(this.last_active);
    if(drop.hoverclass)
      Element.addClassName(drop.element, drop.hoverclass);
    this.last_active = drop;
  },

  show: function(event, element) {
    if(!this.drops.length) return;
    var pX = Event.pointerX(event);
    var pY = Event.pointerY(event);
    Position.prepare();

    var i = this.drops.length-1; do {
      var drop = this.drops[i];
      if(this.isAffected(pX, pY, element, drop)) {
        if(drop.onHover)
           drop.onHover(element, drop.element, Position.overlap(drop.overlap, drop.element));
        if(drop.greedy) { 
          this.activate(drop);
          return;
        }
      }
    } while (i--);
    
    if(this.last_active) this.deactivate(this.last_active);
  },

  fire: function(event, element) {
    if(!this.last_active) return;
    Position.prepare();

    if (this.isAffected(Event.pointerX(event), Event.pointerY(event), element, this.last_active))
      if (this.last_active.onDrop) 
        this.last_active.onDrop(element, this.last_active.element, event);
  },

  reset: function() {
    if(this.last_active)
      this.deactivate(this.last_active);
  }
}

var Draggables = {
  observers: [],
  addObserver: function(observer) {
    this.observers.push(observer);
    this._cacheObserverCallbacks();
  },
  removeObserver: function(element) {  // element instead of observer fixes mem leaks
    this.observers = this.observers.reject( function(o) { return o.element==element });
    this._cacheObserverCallbacks();
  },
  notify: function(eventName, draggable, event) {  // 'onStart', 'onEnd', 'onDrag'
    if(this[eventName+'Count'] > 0)
      this.observers.each( function(o) {
        if(o[eventName]) o[eventName](eventName, draggable, event);
      });
  },
  _cacheObserverCallbacks: function() {
    ['onStart','onEnd','onDrag'].each( function(eventName) {
      Draggables[eventName+'Count'] = Draggables.observers.select(
        function(o) { return o[eventName]; }
      ).length;
    });
  }
}

/*--------------------------------------------------------------------------*/

var Draggable = Class.create();
Draggable.prototype = {
  initialize: function(element) {
    var options = Object.extend({
      handle: false,
      starteffect: function(element) { 
        new Effect.Opacity(element, {duration:0.2, from:1.0, to:0.7}); 
      },
      reverteffect: function(element, top_offset, left_offset) {
        var dur = Math.sqrt(Math.abs(top_offset^2)+Math.abs(left_offset^2))*0.02;
        new Effect.MoveBy(element, -top_offset, -left_offset, {duration:dur});
      },
      endeffect: function(element) { 
         new Effect.Opacity(element, {duration:0.2, from:0.7, to:1.0}); 
      },
      zindex: 1000,
      revert: false,
      snap: false   // false, or xy or [x,y] or function(x,y){ return [x,y] }
    }, arguments[1] || {});

    this.element      = $(element);
    if(options.handle && (typeof options.handle == 'string'))
      this.handle = Element.childrenWithClassName(this.element, options.handle)[0];
      
    if(!this.handle) this.handle = $(options.handle);
    if(!this.handle) this.handle = this.element;

    this.offsetX      = 0;
    this.offsetY      = 0;
    this.originalLeft = this.currentLeft();
    this.originalTop  = this.currentTop();
    this.originalX    = this.element.offsetLeft;
    this.originalY    = this.element.offsetTop;

    this.options      = options;

    this.active       = false;
    this.dragging     = false;

    this.eventMouseDown = this.startDrag.bindAsEventListener(this);
    this.eventMouseUp   = this.endDrag.bindAsEventListener(this);
    this.eventMouseMove = this.update.bindAsEventListener(this);
    this.eventKeypress  = this.keyPress.bindAsEventListener(this);
    
    this.registerEvents();
  },
  destroy: function() {
    Event.stopObserving(this.handle, "mousedown", this.eventMouseDown);
    this.unregisterEvents();
  },
  registerEvents: function() {
  	//if(!Draggable.eventsRegistered) {
  		//Draggable.eventsRegistered = true;
	    Event.observe(document, "mouseup", this.eventMouseUp);
	   	Event.observe(document, "mousemove", this.eventMouseMove);
	    Event.observe(document, "keypress", this.eventKeypress);
	    Event.observe(this.handle, "mousedown", this.eventMouseDown);
	  //}
  },
  unregisterEvents: function() {
  	//if(!Draggable.eventsRegistered) {
  		//Draggable.eventsRegistered = false;
	    //if(!this.active) return;
	    Event.stopObserving(document, "mouseup", this.eventMouseUp);
	    Event.stopObserving(document, "mousemove", this.eventMouseMove);
	    Event.stopObserving(document, "keypress", this.eventKeypress);
	  //}
  },
  currentLeft: function() {
    return parseInt(this.element.style.left || '0');
  },
  currentTop: function() {
    return parseInt(this.element.style.top || '0')
  },
  startDrag: function(event) {
    if(Event.isLeftClick(event)) {
      
      // abort on form elements, fixes a Firefox issue
      var src = Event.element(event);
      if(src.tagName && (
        src.tagName=='INPUT' ||
        src.tagName=='SELECT' ||
        src.tagName=='BUTTON' ||
        src.tagName=='TEXTAREA')) return;
      
      // this.registerEvents();
    	Element.makePositioned(this.element); // fix IE    

	    this.element.wasDragged = false;

      this.active = true;
      var pointer = [Event.pointerX(event), Event.pointerY(event)];
      var offsets = Position.cumulativeOffset(this.element);
      this.offsetX =  (pointer[0] - offsets[0]);
      this.offsetY =  (pointer[1] - offsets[1]);
      Event.stop(event);
    }
  },
  finishDrag: function(event, success) {
    // this.unregisterEvents();

    this.active = false;
    this.dragging = false;
    this.element.wasDragged = true;

    if(this.options.ghosting) {
      Position.relativize(this.element);
      Element.remove(this._clone);
      this._clone = null;
    }

    if(success) Droppables.fire(event, this.element);
    Draggables.notify('onEnd', this, event);

    var revert = this.options.revert;
    if(revert && typeof revert == 'function') revert = revert(this.element);

    if(revert && this.options.reverteffect) {
      this.options.reverteffect(this.element, 
      this.currentTop()-this.originalTop,
      this.currentLeft()-this.originalLeft);
    } else {
      this.originalLeft = this.currentLeft();
      this.originalTop  = this.currentTop();
    }

    if(this.options.zindex)
      this.element.style.zIndex = this.originalZ;

    if(this.options.endeffect) 
      this.options.endeffect(this.element);


    Droppables.reset();
  },
  keyPress: function(event) {
    if(this.active) {
      if(event.keyCode==Event.KEY_ESC) {
   			Element.undoPositioned(this.element);
        this.finishDrag(event, false);
        Event.stop(event);
      }
    }
  },
  endDrag: function(event) {
 		Element.undoPositioned(this.element);
    if(this.active && this.dragging) {
      this.finishDrag(event, true);
      Event.stop(event);
    }
    this.active = false;
    this.dragging = false;
  },
  draw: function(event) {
    var pointer = [Event.pointerX(event), Event.pointerY(event)];
    var offsets = Position.cumulativeOffset(this.element);
    offsets[0] -= this.currentLeft();
    offsets[1] -= this.currentTop();
    var style = this.element.style;
    
    var pos = [
      (pointer[0] - offsets[0] - this.offsetX),
      (pointer[1] - offsets[1] - this.offsetY)];
    
    if(this.options.snap) {
      if(typeof this.options.snap == 'function') {
        pos = this.options.snap(pos[0],pos[1]);
      } else {
      var draggable = this;
      if(this.options.snap instanceof Array) {
        pos = pos.collect( function(v, i) {
          return Math.round(v/draggable.options.snap[i])*draggable.options.snap[i] })
      } else {
        pos = pos.collect( function(v) {
          return Math.round(v/draggable.options.snap)*draggable.options.snap })
      }
    }}
    
    if((!this.options.constraint) || (this.options.constraint=='horizontal'))
      style.left = pos[0] + "px";
    if((!this.options.constraint) || (this.options.constraint=='vertical'))
      style.top  = pos[1] + "px";
    if(style.visibility=="hidden") style.visibility = ""; // fix gecko rendering
  },
  update: function(event) {
   if(this.active) {
      if(!this.dragging) {
	      if(this.options.onStartDrag) this.options.onStartDrag(this.element);

        var style = this.element.style;
        this.dragging = true;
        
        if(Element.getStyle(this.element,'position')=='') 
          style.position = "relative";
        
        if(this.options.zindex) {
          this.originalZ = parseInt(Element.getStyle(this.element,'z-index') || 0);
          style.zIndex = this.options.zindex;
        }

        if(this.options.ghosting) {
          this._clone = this.element.cloneNode(true);
          Position.absolutize(this.element);
          this.element.parentNode.insertBefore(this._clone, this.element);
        }

        Draggables.notify('onStart', this, event);
        if(this.options.starteffect) this.options.starteffect(this.element);
      }

      Droppables.show(event, this.element);
      Draggables.notify('onDrag', this, event);
      this.draw(event);
      if(this.options.change) this.options.change(this);

      // fix AppleWebKit rendering
      if(navigator.appVersion.indexOf('AppleWebKit')>0) window.scrollBy(0,0); 

      Event.stop(event);
	  }
  }
}

function rollingStatus(chr, maxLength) {
	var txt = window.status + chr;
	if(txt.length > maxLength) txt = txt.substr(txt.length - maxLength);
	window.status = txt;
}

/*--------------------------------------------------------------------------*/

var SortableObserver = Class.create();
SortableObserver.prototype = {
  initialize: function(element, observer) {
    this.element   = $(element);
    this.observer  = observer;
    this.lastValue = Sortable.serialize(this.element);
  },
  onStart: function() {
    this.lastValue = Sortable.serialize(this.element);
  },
  onEnd: function() {
    Sortable.unmark();
    if(this.lastValue != Sortable.serialize(this.element))
      this.observer(this.element)
  }
}

var Sortable = {
  sortables: new Array(),
  options: function(element){
    element = $(element);
    return this.sortables.detect(function(s) { return s.element == element });
  },
  destroy: function(element){
    element = $(element);
    this.sortables.findAll(function(s) { return s.element == element }).each(function(s){
      Draggables.removeObserver(s.element);
      s.droppables.each(function(d){ Droppables.remove(d) });
      s.draggables.invoke('destroy');
    });
    this.sortables = this.sortables.reject(function(s) { return s.element == element });
  },
  create: function(element) {
  	
    element = $(element);
    var options = Object.extend({ 
      element:     element,
      tag:         'li',       // assumes li children, override with tag: 'tagname'
      dropOnEmpty: false,
      tree:        false,      // fixme: unimplemented
      overlap:     'vertical', // one of 'vertical', 'horizontal'
      constraint:  'vertical', // one of 'vertical', 'horizontal', false
      containment: element,    // also takes array of elements (or id's); or false
      handle:      false,      // or a CSS class
      only:        false,
      hoverclass:  null,
      ghosting:    false,
      format:      null,
      onChange:    Prototype.emptyFunction,
      onUpdate:    Prototype.emptyFunction
    }, arguments[1] || {});

    // clear any old sortable with same element
    this.destroy(element);

    // build options for the draggables
    var options_for_draggable = {
      revert:      true,
      ghosting:    options.ghosting,
      constraint:  options.constraint,
      handle:      options.handle };

    if(options.starteffect)
      options_for_draggable.starteffect = options.starteffect;

    if(options.reverteffect)
      options_for_draggable.reverteffect = options.reverteffect;
    else
      if(options.ghosting) options_for_draggable.reverteffect = function(element) {
        element.style.top  = 0;
        element.style.left = 0;
      };

    if(options.endeffect)
      options_for_draggable.endeffect = options.endeffect;

    if(options.zindex)
      options_for_draggable.zindex = options.zindex;

    // build options for the droppables  
    var options_for_droppable = {
      overlap:     options.overlap,
      containment: options.containment,
      hoverclass:  options.hoverclass,
      onHover:     Sortable.onHover,
      greedy:      !options.dropOnEmpty
    }

    // fix for gecko engine
    Element.cleanWhitespace(element); 

    options.draggables = [];
    options.droppables = [];

    // make it so

    // drop on empty handling
    if(options.dropOnEmpty) {
      Droppables.add(element,
        {containment: options.containment, onHover: Sortable.onEmptyHover, greedy: false});
      options.droppables.push(element);
    }

    (this.findElements(element, options) || []).each( function(e) {
      // handles are per-draggable
      var handle = options.handle ? 
        Element.childrenWithClassName(e, options.handle)[0] : e;    
      options.draggables.push(
        new Draggable(e, Object.extend(options_for_draggable, { handle: handle })));
      Droppables.add(e, options_for_droppable);
      options.droppables.push(e);      
    });

    // keep reference
    this.sortables.push(options);

    // for onupdate
    Draggables.addObserver(new SortableObserver(element, options.onUpdate));

  },

  // return all suitable-for-sortable elements in a guaranteed order
  findElements: function(element, options) {
    if(!element.hasChildNodes()) return null;
    var elements = [];
    $A(element.childNodes).each( function(e) {
      if(e.tagName && e.tagName==options.tag.toUpperCase() &&
        (!options.only || (Element.hasClassName(e, options.only))))
          elements.push(e);
      if(options.tree) {
        var grandchildren = this.findElements(e, options);
        if(grandchildren) elements.push(grandchildren);
      }
    });

    return (elements.length>0 ? elements.flatten() : null);
  },

  onHover: function(element, dropon, overlap) {
    if(overlap>0.5) {
      Sortable.mark(dropon, 'before');
      if(dropon.previousSibling != element) {
        var oldParentNode = element.parentNode;
        element.style.visibility = "hidden"; // fix gecko rendering
        dropon.parentNode.insertBefore(element, dropon);
        if(dropon.parentNode!=oldParentNode) 
          Sortable.options(oldParentNode).onChange(element);
        Sortable.options(dropon.parentNode).onChange(element);
      }
    } else {
      Sortable.mark(dropon, 'after');
      var nextElement = dropon.nextSibling || null;
      if(nextElement != element) {
        var oldParentNode = element.parentNode;
        element.style.visibility = "hidden"; // fix gecko rendering
        dropon.parentNode.insertBefore(element, nextElement);
        if(dropon.parentNode!=oldParentNode) 
          Sortable.options(oldParentNode).onChange(element);
        Sortable.options(dropon.parentNode).onChange(element);
      }
    }
  },

  onEmptyHover: function(element, dropon) {
    if(element.parentNode!=dropon) {
      var oldParentNode = element.parentNode;
      dropon.appendChild(element);
      Sortable.options(oldParentNode).onChange(element);
      Sortable.options(dropon).onChange(element);
    }
  },

  unmark: function() {
    if(Sortable._marker) Element.hide(Sortable._marker);
  },

  mark: function(dropon, position) {
    // mark on ghosting only
    var sortable = Sortable.options(dropon.parentNode);
    if(sortable && !sortable.ghosting) return; 

    if(!Sortable._marker) {
      Sortable._marker = $('dropmarker') || document.createElement('DIV');
      Element.hide(Sortable._marker);
      Element.addClassName(Sortable._marker, 'dropmarker');
      Sortable._marker.style.position = 'absolute';
      document.getElementsByTagName("body").item(0).appendChild(Sortable._marker);
    }    
    var offsets = Position.cumulativeOffset(dropon);
    Sortable._marker.style.left = offsets[0] + 'px';
    Sortable._marker.style.top = offsets[1] + 'px';
    
    if(position=='after')
      if(sortable.overlap == 'horizontal') 
        Sortable._marker.style.left = (offsets[0]+dropon.clientWidth) + 'px';
      else
        Sortable._marker.style.top = (offsets[1]+dropon.clientHeight) + 'px';
    
    Element.show(Sortable._marker);
  },

  serialize: function(element) {
    element = $(element);
    var sortableOptions = this.options(element);
    var options = Object.extend({
      tag:  sortableOptions.tag,
      only: sortableOptions.only,
      name: element.id,
      format: sortableOptions.format || /^[^_]*_(.*)$/
    }, arguments[1] || {});
    var ret = $(this.findElements(element, options) || []).collect( function(item) {
      return (encodeURIComponent(options.name) + "[]=" + 
              encodeURIComponent(item.id.match(options.format) ? item.id.match(options.format)[1] : ''));
    }).join("&");
    return ret;
  }
} 