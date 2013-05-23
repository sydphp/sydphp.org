<div class="span10">
    <p>SydPHP could not be the ongoing success and enjoyable event that it has grown to become today, without the ongoing generous support of our sponsors.</p>
    <p>It is though this support that we are able to deliver great quality talks, in a central venue in Sydney, with special events throughout the year.</p>
    
    <h3>Become a sponsor!</h3>
    <p>If you run a business, or work for a company that would like to gain more exposure in the Sydney, and Australia-wide PHP community, consider sponsoring Sydney's PHP user group. Its a great way to get to know developers, reach a new audience, and a superb way to give back to the PHP community.</p>
    <p><?php echo $this->Html->link('Contact us for more information.', array(
        'plugin' => 'enquiries',
        'controller' => 'enquiries',
        'action' => 'add',
    )); ?></p>
    
    <ul>
        <li><a href="#ongoing">Ongoing Sponsors</a></li>
        <li><a href="#phunconf3">Phunconference 3.0 (Dec 2012)</a></li>
    </ul>
    
    <a name="ongoing">
    <br/>
    <h2>Ongoing sponsors:</h2>
    <?php
    
    echo $this->element('sponsor', array(
        'name' => '4mation Technologies',
        'url'  => 'http://www.4mation.com.au/',
        'logo' => '/img/sponsor/4mation.jpg',
        'text' => array(
            '4mation Technologies are one of Australia\'s leading website and software development companies, specialising in custom PHP development.',
            'With a 100% local team of almost 40 professional designers, developers, producers and project managers, 4mation has a proven 11 year track record of delivering high quality commercial projects.',
            'Whether it\'s development of a new project, or rescuing a struggling existing website or system, 4mation can help.',
            '4mation Technologies support the Sydney PHP user group by providing us with finances to book meeting rooms on a regular basis. It is through this support that we are able to provide free events.'            
        ),
    )); 
    
    echo $this->element('sponsor', array(
        'name' => 'Ninefold',
        'url'  => 'http://ninefold.com/',
        'logo' => '/img/sponsor/Ninefold.jpg',
        'text' => array(
            'Ninefold is Australian cloud computing and storage with locally stored data, free local support, self service flexibility and low latency.',
            'With easy online signup, you can enter your details and provision virtual servers and cloud storage within minutes - scaling up and down when needed.',
            'Check their website for more information.'
        ),
    ));
    
    echo $this->element('sponsor', array(
        'name' => 'Mammoth Media',
        'url'  => 'http://www.mammothvps.com.au/vps/plans?ref=efb3c177e80549afbbc69f36011fee24',
        'logo' => '/img/sponsor/MammothMedia.jpg',
        'text' => array(
            'Mammoth Media support the SydPHP user group through the provision of kickass servers for hosting the SydPHP website.',
            'Their servers are local, reasonably priced, and they have a great support team.',
            'Mammoth also provide development services, content management, consulting, search engine optimisation and more.'
        ),
    ));

    echo $this->element('sponsor', array(
        'name' => 'Spinifex Group',
        'url'  => 'http://www.spinifexgroup.com',
        'logo' => '/img/sponsor/Spinifex.jpg',
        'text' => array(
            'The Spinifex Group show their support for the Sydney PHP user group by providing us with finances to book meeting rooms on a regular basis. It is through this support that we are able to provide free events.',
            'They are a creative communications company, recognised as one of the world leaders in the highly specialised field of experience media.'
        ),
    ));

    echo $this->element('sponsor', array(
        'name' => 'Cake Development Corporation',
        'url'  => 'http://www.cakedc.com',
        'logo' => 'http://photos4.meetupstatic.com/photos/sponsor/c/7/d/0/iab120x90_471152.jpeg',
        'text' => array(
            'The Cake Development Corporation occasionally puts up money to purchase food, drinks, and more. Further, they allow the time out of regular work days to enable the organisers to co-ordinate and manage the meetup events.',
            'CakeDC provides development and consulting services, specialising in CakePHP application development.',
            'They also provide mobile application development, and training services.'
        ),
    ));
    ?>

    <a name="phunconf3">
    <br/>
    <h2>Event Sponsors - Phunconference 3.0</h2>
    <?php
    echo $this->element('sponsor', array(
        'name' => 'Ninefold',
        'url'  => 'http://ninefold.com/',
        'logo' => '/img/sponsor/Ninefold.jpg',
        'text' => array(
            'As well as being an ongoing sponsor of SydPHP, Ninefold organised all of the cold beer, provided a $1000 cloud hosting voucher, fantastic t-shirts and free trial vouchers at Phunconference 3.0.'         
        ),
    ));
    
    echo $this->element('sponsor', array(
        'name' => 'Spinifex Group',
        'url'  => 'http://www.spinifexgroup.com',
        'logo' => '/img/sponsor/Spinifex.jpg',
        'text' => array(
            'As well as being an ongoing sponsor of SydPHP, Spinifex provided the food at Phunconference 3.0.'
        ),
    ));
    
    echo $this->element('sponsor', array(
        'name' => 'Praxis BT',
        'url'  => 'http://www.praxisbt.com',
        'logo' => '/img/sponsor/Praxis.jpg',
        'text' => array(
            'Praxis BT is a business and technology consultancy and offer a comprehensive range of services and solutions spanning the business strategy, technology consulting, systems integration and marketing disciplines.',
            'Praxis BT provided a 10.1 inch Samsung Galaxy Tab to give away as a prize at Phunconference 3.0.'
        ),
    ));
        
    echo $this->element('sponsor', array(
        'name' => 'Rewired State',
        'url'  => 'http://www.rewiredstate.com.au',
        'logo' => '/img/sponsor/RewiredState.jpg',
        'text' => array(            
            'Rewired State run hack days. ',
            'Rewired State provided a major prize at Phunconference 3.0, a Nintendo Wii U for the best Lightning Talk.'
        ),
    )); 
    
    echo $this->element('sponsor', array(
        'name' => 'Zend Technologies Inc.',
        'url'  => 'http://www.zend.com',
        'logo' => '/img/sponsor/Zend.jpg',
        'text' => array(            
            'Businesses utilizing PHP know Zend as the place to go for PHP expertise and sound technology solutions. Zend\'s founders Andi Gutmans and Zeev Suraski are key contributors to PHP and the creators of the core PHP scripting engine, the Zend Engine.',
            'Zend provided a major prize at Phunconference 3.0, a voucher for the online training course of the winner\'s choice.'
        ),
    )); 
    
    
    echo $this->element('sponsor', array(
        'name' => '4mation Technologies',
        'url'  => 'http://www.4mation.com.au/',
        'logo' => '/img/sponsor/4mation.jpg',
        'text' => array(
            'As well as being an ongoing sponsor of SydPHP, 4mation Technologies provided a $100 JB Hi-Fi voucher to give away at Phunconference 3.0.'                      
        ),
    )); 
    
    ?>
</div>

<div class="span4 sidebar">
    <?php echo $this->element('layout/sidebar'); ?>
</div>
