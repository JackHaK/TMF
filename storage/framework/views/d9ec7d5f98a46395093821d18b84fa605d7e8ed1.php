<!doctype html>
<html>
<head>
    <?php echo $__env->make('includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</head>
<body>
<div class="flex-center position-ref full-height">

    <header class="row">
        <?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
      <div class="row text-center top-three">
        <div class="col-md-2 col-md-offset-5">
          <div class="half-circle-spinner">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
          </div>
        </div>
      </div>
    </div>

    <footer class="bottom-left">
        <?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </footer>

</div>
<?php $route = '/events/inflateAll' ?>
<?php echo $__env->make($script, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>
