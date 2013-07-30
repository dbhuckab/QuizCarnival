
<section class="item">
    <section class="content">
    <?php echo form_open('admin/personality_quizzes/delete'); ?>

        <?php if (!empty($items)): ?>

            <table>
                <thead>
                    <tr>
                        <th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
                        <th><?php echo lang('personality_quizzes:title'); ?></th>
                        <th><?php echo lang('personality_quizzes:slug'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                        </td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo form_checkbox('action_to[]', $item->idQuiz); ?></td>
                            <td><?php echo $item->title; ?></td>
                            <td><?php echo $item->slug;?></td>
                            <td class="actions">
                                <?php
                                echo
                                anchor('personality_quizzes/'.$item->idQuiz, lang('personality_quizzes:view'), 'class="button" target="_blank"') . ' ' .
                                anchor('admin/personality_quizzes/edit/' . $item->idQuiz, lang('personality_quizzes:edit'), 'class="button"') . ' ' .
                                anchor('admin/personality_quizzes/delete/' . $item->idQuiz, lang('personality_quizzes:delete'), array('class' => 'button'));
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="table_action_buttons">
            <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
            </div>

        <?php else: ?>
            <div class="no_data"><?php echo lang('personality_quizzes:no_items'); ?></div>
        <?php endif; ?>

    <?php echo form_close(); ?>
    </section>
</section>