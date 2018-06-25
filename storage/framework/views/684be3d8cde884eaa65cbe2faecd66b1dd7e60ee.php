

<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-heading">
        Future Events :-
      </div>
      <div class="panel-body pre-scrollable" style="background-color:lightgrey">
        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <p>ID: <?php echo e($event->courseID'); ?> - <?php echo e($event->courseTitle); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-4">
    <a class="btn btn-primary" href="/events/<?php echo e($eventID); ?>/edit">
      Update
    </a>
    <a class="btn btn-primary" href="/">
      Cancel
    </a>
  </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.content', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>