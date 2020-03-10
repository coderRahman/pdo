<?php include "inc/header.php"; ?>
<div class="container">
    <div class="row">
        <div class="offset-sm-2 col-8">
            <div class="card">
                <div class="card-header">
                    <h2>Add Student</h2>
                </div>
                <div class="card-body">
                    <form action="lib/process_student.php" method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required="1">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required="1">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="action" value="add">
                            <input type="submit" name="submit" value="Add Student">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>