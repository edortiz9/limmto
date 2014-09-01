<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Template.Isis
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

$alert = array('error' => 'alert-error', 'warning' => '', 'notice' => 'alert-info', 'message' => 'alert-success');
?>
<div id="notify">
    <div id="system-message-container">
            <?php if (is_array($msgList) && !empty($msgList)) : ?>
                            <?php foreach ($msgList as $type => $msgs) : ?>
                                    <div id="login-status" class="<?php echo $type."-notice"; ?>">
                                        <span class="login-status-icon"></span>
                                        <?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
                                        <a class="close" data-dismiss="alert">×</a>
                                        <?php if (!empty($msgs)) : ?>
                                                <div id="login-status-message">
                                                        <?php foreach ($msgs as $msg) : ?>
                                                            <p><?php echo $msg; ?></p>
                                                        <?php endforeach; ?>
                                                </div>
                                        <?php endif; ?>
                                    </div>
                            <?php endforeach; ?>
            <?php endif; ?>
    </div>
</div>