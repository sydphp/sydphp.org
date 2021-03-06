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
        <li><a href="#phunconf4">Phunconference 4.0 (Jan 2014)</a></li>
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
            'With a 100% local team of almost 40 professional designers, developers, producers and project managers, 4mation has a proven 12 year track record of delivering high quality commercial projects.',
            'Whether it\'s development of a new project, or rescuing a struggling existing website or system, 4mation can help.',
            '4mation Technologies support the Sydney PHP user group by providing us with finances to book meeting rooms on a regular basis. It is through this support that we are able to provide free events.'            
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
    
    ?>

    <a name="phunconf4">
    <br/>
    <h2>Event Sponsors - Phunconference 4.0</h2>
    <?php

echo $this->element('sponsor', array(
        'name' => '4mation Technologies',
        'url'  => 'http://www.4mation.com.au/',
        'logo' => '/img/sponsor/4mation.jpg',
        'text' => array(
            'As well as being an ongoing sponsor of SydPHP, 4mation Technologies are the official beer and cider sponsor for Phunconference 4.0.'                      
        ),
    )); 

    echo $this->element('sponsor', array(
        'name' => 'Dominos',
        'url'  => 'http://www.dominos.com.au',
        'logo' => '/img/sponsor/Dominos.jpg',
        'text' => array(
            'Dominos are the official hunger slaying pizza sponsor for Phunconference 4.0.'
        ),
    ));
    
    echo $this->element('sponsor', array(
        'name' => 'Anchor Systems',
        'url'  => 'http://www.anchor.com.au',
        'logo' => '/img/sponsor/Anchor.gif',
        'text' => array(
            'Anchor Systems are showing us love by providing some light snacks for Phunconference 4.0.'
        ),
    ));

    echo $this->element('sponsor', array(
        'name' => 'The Iconic',
        'url'  => 'http://www.theiconic.com.au',
        'logo' => '/img/sponsor/Iconic.png',
        'text' => array(            
            'The Iconic will be helpping us look awesome by providing 3 x $100 vouchers as giveaway prizes along with a large quantity of discount vouchers.'
        ),
    )); 
    
    echo $this->element('sponsor', array(
        'name' => 'Webyog',
        'url'  => 'https://www.webyog.com/product/sqlyog',
        'logo' => '/img/sponsor/Webyog.png',
        'text' => array(            
            'Webyog will help a couple of our members by providing 2x Ultimate licenses of SQLyog for 1 year as giveaway prizes.'
        ),
    )); 

    echo $this->element('sponsor', array(
        'name' => 'Codeship.io',
        'url'  => 'http://www.codeshio.io',
        'logo' => '/img/sponsor/Codeship.png',
        'text' => array(            
            'Codeship.io will be helping our members continously deploy with an unlimited number of 2 month free trials on their Large plan (worth $50 a month).'
        ),
    )); 

    echo $this->element('sponsor', array(
        'name' => 'JetBrains',
        'url'  => 'www.jetbrains.com',
        'logo' => '/img/sponsor/JetBrains.jpg',
        'text' => array(            
            'JetBrains will be delighting 3 of our members by giving away 3 licenses for PHPStorm.'
        ),
    )); 
    
    echo $this->element('sponsor', array(
        'name' => 'Google',
        'url'  => 'https://www.google.com.au',
        'logo' => '/img/sponsor/Google.jpg',
        'text' => array(            
            'Google will be providing the fantastic venue, equipment and some Googlers to help make Phunconference 4.0 a reality.'
        ),
    )); 
    
    ?>
</div>

<div class="span4 sidebar">
    <?php echo $this->element('layout/sidebar'); ?>
</div>
