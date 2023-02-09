<?php
function podaci_o_klijentu() {
    global $wpdb;

    $sImeTabliceDva = $wpdb->prefix."podaci_o_klijentu";

    $sql = "CREATE TABLE $sImeTabliceDva(
        id int(11) NOT NULL AUTO_INCREMENT,
        ime varchar(255),
        prezime varchar(255),
        email varchar(255),
        telefon varchar(255),
        datumod varchar(255),
        datumdo varchar(255),
        idHotel varchar(255),
        idSoba varchar(255),
        PRIMARY KEY (id)
    )";

    require_once( ABSPATH."wp-admin/includes/upgrade.php");
    dbDelta($sql);
}

?> 