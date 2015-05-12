<div class="container">
    <h2>Result of Upload: </h2>
</div>

<div class="container">
    <h2>Reported Failures</h2>
    <div>
    <?php if(count($errors) == 0) {
         echo "Nothing to Report"; 
     } else {
        foreach ($errors as $err) { ?>
                <p><?php echo $err?></p>
        <?php } } ?>
    </div>
</div>

<div class="container">
    <h2>Reported Success</h2>
    <div>
    <?php if(count($success) == 0) {
         echo "Nothing to Report"; 
     } else {
        foreach ($success as $succ) { ?>
            <p><?php echo $succ ?></p>
        <?php } } ?>
    </div>
</div>