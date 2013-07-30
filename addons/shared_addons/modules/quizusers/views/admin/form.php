<?php /*
<section class="title">
    <!-- We'll use $this->method to switch between sample.create & sample.edit -->
    <h4><?php echo lang('quizusers:' . $this->method); ?></h4>
</section>
*/ ?>
 <?php echo validation_errors(); ?>  
<div class="tabs">
    <ul class="tab-menu">
        <li><a href="#panel1"><span>User Info</span></a></li>
        <li><a href="#panel2"><span>Taken Quizzes</span></a></li>
        <li><a href="#panel3"><span>Activity</span></a></li>
        <li><a href="#panel4"><span>Balance and Transactions</span></a></li>
        <li><a href="#panel5"><span>Prizes / Achievements</span></a></li>
    </ul>
    <div id="panel1">

        <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

        <section class="item">
            <section class="content">


                <div class="form_inputs">

                    <ul>
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="email"><?php echo lang('quizusers:email'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('email', set_value('email', $quizuser->email), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="username"><?php echo lang('quizusers:username'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('username', set_value('username', $quizuser->username), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="firstName"><?php echo lang('quizusers:firstName'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('firstName', set_value('firstName', $quizuser->firstName), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="lastName"><?php echo lang('quizusers:lastName'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('lastName', set_value('lastName', $quizuser->lastName), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="facebookId"><?php echo lang('quizusers:facebookId'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('facebookId', set_value('facebookId', $quizuser->facebookId), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'password'); ?>">
                            <label for="password"><?php echo lang('quizusers:password'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('password', set_value('password', $quizuser->password), 'class="width-15"'); ?></div>
                        </li>
                    </ul>

                </div>

                <div class="buttons">
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>


            </section>

        </section>

        <?php echo form_close(); ?>
    </div>

    <div id="panel2">
        ...
    </div>
    
    <div id="panel3">
        ...
    </div>
    
    <div id="panel4">
        ...
    </div>
    
    <div id="panel5">
        ...
    </div>
</div>