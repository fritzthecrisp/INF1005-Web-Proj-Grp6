<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>
<h1><?= $page_name ?></h1>
<div class="col-12 col-md-8 offset-md-2">
    <form method="post">
        <div class="form-group">
            <label for="">Title</label> 
            <input type="text" class="form-control" name="workout_name" value="<?= $workout['workout_name'] ?>">
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea type="text" class="form-control" name="workout_description" rows="3"><?= $workout['workout_description'] ?></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-sm">Save</button>
        </div>
    </form>
</div>
<?= $this->endSection('content') ?>