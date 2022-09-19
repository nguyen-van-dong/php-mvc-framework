<script type="application/javascript" src="/assets/js/calendar.js"></script>
<link rel="stylesheet" href="/assets/css/style.css">

<div>
    <a class="btn btn-primary" href="./create-task">Add Task</a><br><br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php if (isset($_SESSION['DELETED'])) {?>
                <div class="alert alert-primary" role="alert">
                    <h6><?php echo $_SESSION['DELETED'];  unset($_SESSION['DELETED']);?></h6>
                </div>
            <?php }?>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="response"></div>
    <div id='calendar'></div>
    <div style="margin-bottom: 100px"></div>
</div>

