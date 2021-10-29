<div class="row" data-handle="<?php echo $title ?>">
    <div class="card">
        <div class="card-body">
            <?php if($deletable) {?>
            <button type="button" class="btn-close pull-right mr-0 deleteCountry" aria-label="Close" data-country="<?php echo $title; ?>"></button>
            <?php } ?>
            <h3><?php echo $title ?></h3>
            <div class="row">
                <div class="col-3"><?php echo $confirmed['value'] ?> Confirmed</div>
                <div class="col-3"><?php echo $recovered['value'] ?> Recovered</div>
                <div class="col-3"><?php echo $deaths['value'] ?> Deceased</div>
            </div>
        </div>
    </div>
</div>