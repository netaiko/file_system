<?php
/**
 * Created by JOSE ARIAS MORALES
 * Date: 11/04/2020
 * Time: 14:03
 */

?>
<div class="m-b-md">
    Recursive File Structure
</div>

<nav class="navbar navbar-light flex-center">
    <form class="form-inline" action="/" method="get">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search"
               value="<?php echo $search ?? ''; ?>">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</nav>
<div>
    <?php foreach ($folders as $folder) { ?>
        <div><span class="path"><?php echo $folder->getAbsolutePath(); ?></span></div>
    <?php } ?>


    <?php foreach ($files as $file) { ?>
        <div>
            <span class="path">
                <?php echo $file->getAbsolutePath() . '\\' ?></span><span class="file"><?php echo $file->getName() ?>
            </span>
        </div>
    <?php } ?>

    <?php if (empty($folders) && empty($files) && !empty($search)) { ?>
        <p>No results have been found</p>
    <?php } ?>

</div>
