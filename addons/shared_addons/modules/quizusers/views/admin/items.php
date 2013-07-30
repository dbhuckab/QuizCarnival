
<section class="item">
    <section class="content">
    <?php echo form_open('admin/quizusers/delete'); ?>

        <?php if (!empty($items)): ?>

            <table>
                <thead>
                    <tr>
                        <th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
                        <th><?php echo lang('quizusers:name'); ?></th>
                        <th><?php echo lang('quizusers:firstName'); ?></th>
                        <th><?php echo lang('quizusers:lastName'); ?></th>
                        <th><?php echo lang('quizusers:facebookId'); ?></th>
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
                            <td><?php echo form_checkbox('action_to[]', $item->idUser); ?></td>
                            <td><?php echo $item->email; ?></td>
                            <td><?php echo $item->firstName;?></td>
                            <td><?php echo $item->lastName;?></td>
                            <td><?php echo $item->facebookId;?></td>
                            <td class="actions">
                                <?php
                                echo
                                anchor('quizusers/'.$item->idUser, lang('quizusers:view'), 'class="button" target="_blank"') . ' ' .
                                anchor('admin/quizusers/edit/' . $item->idUser, lang('quizusers:edit'), 'class="button"') . ' ' .
                                anchor('admin/quizusers/delete/' . $item->idUser, lang('quizusers:delete'), array('class' => 'button'));
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
            <div class="no_data"><?php echo lang('quizusers:no_items'); ?></div>
        <?php endif; ?>

    <?php echo form_close(); ?>
    </section>
</section>