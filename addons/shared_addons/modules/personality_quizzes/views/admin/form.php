<?php /*
<section class="title">
    <!-- We'll use $this->method to switch between sample.create & sample.edit -->
    <h4><?php echo lang('quizusers:' . $this->method); ?></h4>
</section>
*/ ?>
 <?php echo validation_errors(); ?>  
<div class="tabs">
    <ul class="tab-menu">
        <li><a href="#panel1"><span>Quiz Details</span></a></li>
        <li><a href="#panel2"><span>Questions and Answers</span></a></li>
        <li><a href="#panel3"><span>Results</span></a></li>
        <li><a href="#panel4"><span>Options</span></a></li>
    </ul>
    <div id="panel1">

        <?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

        <section class="item">
            <section class="content">


                <div class="form_inputs">

                    <ul>
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="qc_idUser"><?php echo lang('personality_quizzes:user'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('qc_idUser', set_value('qc_idUser', $quiz->qc_idUser), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'odd'); ?>">
                            <label for="slug"><?php echo lang('personality_quizzes:slug'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('slug', set_value('slug', $quiz->slug), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="title"><?php echo lang('personality_quizzes:title'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('title', set_value('title', $quiz->firstName), 'class="width-15"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'odd'); ?>">
                            <label for="description"><?php echo lang('personality_quizzes:description'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_textarea('description', set_value('description', $quiz->lastName), 'class="width-15 wysiwyg-simple"'); ?></div>
                        </li>

                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="image"><?php echo lang('personality_quizzes:image'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_upload('image', set_value('image', $quiz->facebookId), 'class="width-15"'); ?> <a href="#" onclick="$(window).trigger('open-upload');">Trigger</a></div>
                        </li>

                        <li class="<?php echo alternator('', 'odd'); ?>">
                            <label for="is_hidden"><?php echo lang('personality_quizzes:is_hidden'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('is_hidden', set_value('is_hidden', $quiz->password), 'class="width-15"'); ?></div>
                        </li>
                        
                        <li class="<?php echo alternator('', 'even'); ?>">
                            <label for="category"><?php echo lang('personality_quizzes:category'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('category', set_value('category', $quiz->password), 'class="width-15"'); ?></div>
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

</div>