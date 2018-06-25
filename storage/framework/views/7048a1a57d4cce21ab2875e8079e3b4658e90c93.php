
<form id=courseForm class="form-horizontal" action="/events/<?php echo e($eventID); ?>" enctype="multipart/form-data" method="POST">
  <?php echo e(csrf_field()); ?>

<label class="control-label" for="eventSelect">Events:</label>
<select class="form-control" name="eventSelect" id="eventSelect">
  <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($event->id); ?>">Event ID: <?php echo e($event->id); ?> - Course ID: <?php echo e($event->courseID); ?> - <?php echo e($event->courseTitle); ?> - <?php echo e($event->startDate); ?> - £<?php echo e($event->price); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<br>
<input type="submit" value="Submit">
</form>
