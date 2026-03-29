<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="dashboard-page">
    <div class="dashboard-layout">
        <?php require APPROOT . '/views/inc/sidebar.php'; ?>

        <main class="dashboard-main">
            <div class="dashboard-topbar">
                <div>
                    <span class="section-label">Tasks</span>
                    <h1>Add New Task</h1>
                    <p>Create a study task with smart ranking inputs.</p>
                </div>

                <div class="topbar-actions">
                    <a href="<?php echo URLROOT; ?>/tasks" class="btn btn-outline">Back to Tasks</a>
                </div>
            </div>

            <div class="form-panel">
                <form action="<?php echo URLROOT; ?>/tasks/add" method="POST" class="modern-form">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="subject_id">Subject</label>
                            <select name="subject_id" id="subject_id">
                                <option value="">Select Subject</option>
                                <?php foreach ($data['subjects'] as $subject) : ?>
                                    <option value="<?php echo $subject->id; ?>" <?php echo ($data['subject_id'] == $subject->id) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($subject->subject_name); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="form-error"><?php echo $data['subject_id_err']; ?></small>
                        </div>

                        <div class="form-group">
                            <label for="title">Task Title</label>
                            <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>" placeholder="e.g. Database Assignment">
                            <small class="form-error"><?php echo $data['title_err']; ?></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" placeholder="Add task details"><?php echo $data['description']; ?></textarea>
                    </div>

                    <div class="form-grid three-grid">
                        <div class="form-group">
                            <label for="task_type">Task Type</label>
                            <select name="task_type" id="task_type">
                                <?php
                                $taskTypes = ['Assignment', 'Exam', 'Quiz', 'Revision', 'Presentation', 'Lab', 'Other'];
                                foreach ($taskTypes as $type) :
                                ?>
                                    <option value="<?php echo $type; ?>" <?php echo ($data['task_type'] == $type) ? 'selected' : ''; ?>>
                                        <?php echo $type; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select name="priority" id="priority">
                                <?php
                                $priorities = ['Low', 'Medium', 'High'];
                                foreach ($priorities as $priority) :
                                ?>
                                    <option value="<?php echo $priority; ?>" <?php echo ($data['priority'] == $priority) ? 'selected' : ''; ?>>
                                        <?php echo $priority; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="difficulty">Difficulty</label>
                            <select name="difficulty" id="difficulty">
                                <?php
                                $difficulties = ['Easy', 'Medium', 'Hard'];
                                foreach ($difficulties as $difficulty) :
                                ?>
                                    <option value="<?php echo $difficulty; ?>" <?php echo ($data['difficulty'] == $difficulty) ? 'selected' : ''; ?>>
                                        <?php echo $difficulty; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-grid three-grid">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status">
                                <?php
                                $statuses = ['Pending', 'In Progress', 'Completed'];
                                foreach ($statuses as $status) :
                                ?>
                                    <option value="<?php echo $status; ?>" <?php echo ($data['status'] == $status) ? 'selected' : ''; ?>>
                                        <?php echo $status; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="deadline">Deadline</label>
                            <input type="date" name="deadline" id="deadline" value="<?php echo $data['deadline']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="estimated_hours">Estimated Hours</label>
                            <input type="number" step="0.5" min="0.5" name="estimated_hours" id="estimated_hours" value="<?php echo $data['estimated_hours']; ?>" placeholder="e.g. 2">
                            <small class="form-error"><?php echo $data['estimated_hours_err']; ?></small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Task</button>
                        <a href="<?php echo URLROOT; ?>/tasks" class="btn btn-outline">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>