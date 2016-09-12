<?php
/*
 * @support
 * http://www.opensourcetechnologies.com/contactus.html
 * sales@opensourcetechnologies.com
* */
        // Add database
        require('../../config.php');
        $con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
        mysqli_select_db(DB_DATABASE, $con);
        $SQL = "ALTER TABLE `" . DB_PREFIX . "product` ADD `offerprice` INT NOT NULL DEFAULT '0' AFTER `date_modified`;";
        mysqli_query( $con,$SQL);
        $CARTSQL = "ALTER TABLE `" . DB_PREFIX . "cart` ADD `offerprice` INT NOT NULL DEFAULT '0' AFTER `date_mail`;";
        mysqli_query( $con,$CARTSQL);        

        die('Setup Successful !');
?>
