<h1>Update task</h1>

<form method="post">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" value="<?= $task->name ?>"
               class="form-control <?php if (isset($task) && $task->hasError('name')) {echo 'is-invalid'; }?>"
               id="name"
               name="name"
               placeholder="Name"
        >
        <input type="hidden" value="<?= $task->id?>" name="id">
        <div class="invalid-feedback">
            <?php if (isset($task) && $task->hasError('name')) {echo $task->getFirstError('name'); }?>
        </div>
    </div>
        <div class="form-group row component-start_at">
        <label for="start_at" class="col-12 col-form-label font-weight-600 text-left">Start date</label>
        <div class="col-12">
            <input type="text" 
                   class="form-control <?php if (isset($task) && $task->hasError('start_at')) {echo 'is-invalid'; }?> datetimepicker" 
                   name="start_at" 
                   id="start_at" 
                   placeholder="Start date" 
                   value="<?php echo isset($task) ? $task->start_at : '' ?>">
            <div class="invalid-feedback">
                <?php if (isset($task) && $task->hasError('start_at')) { echo $task->getFirstError('start_at'); }?>
            </div>
        </div>
    </div>

    <div class="form-group row component-end_at">
        <label for="expire_at" class="col-12 col-form-label font-weight-600 text-left">End date</label>
        <div class="col-12">
            <input type="text" 
                    class="form-control form-control <?php if (isset($task) && $task->hasError('end_at')) { echo 'is-invalid'; }?> datetimepicker"
                    name="end_at"
                    id="end_at"
                    placeholder="End date"
                    value="<?php echo isset($task) ? $task->end_at : '' ?>"
            >
            <div class="invalid-feedback">
                <?php if (isset($task) && $task->hasError('end_at')) {echo $task->getFirstError('end_at'); }?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="">Status</label>
        <select class="form-control" name="status">
            <option value="1" <?php echo isset($task) && $task->status == 1 ? 'selected' : '' ?> >Planning</option>
            <option value="2" <?php echo isset($task) && $task->status == 2 ? 'selected' : '' ?>>Doing</option>
            <option value="3" <?php echo isset($task) && $task->status == 3 ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="/delete-task?id=<?= $task->id?>" class="btn btn-danger" id="btnDelete">Delete</a>
    <a href="/" class="btn btn-info">Go Back</a>
</form>
