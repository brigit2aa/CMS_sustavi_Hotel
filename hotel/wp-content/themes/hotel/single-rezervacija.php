<?php
get_header();
?>

<?php
if ( have_posts() )
{
while ( have_posts() )
{
  if ( get_post_meta( get_the_ID(), 'rezervacija_info_hotel', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_hotel'])) {
     //echo '<p>Hotel: '.$custom['rezervacija_info_hotel'][0].'</p>';
    }
  } if ( get_post_meta( get_the_ID(), 'rezervacija_info_soba', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_soba'])) {
     // echo '<p>Soba: '.$custom['rezervacija_info_soba'][0].'</p>';
    }
  }
  if ( get_post_meta( get_the_ID(), 'rezervacija_info_ime', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_ime'])) {
     //echo '<p>Ime: '.$custom['rezervacija_info_ime'][0].'</p>';
    }
  } if ( get_post_meta( get_the_ID(), 'rezervacija_info_prezime', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_prezime'])) {
     // echo '<p>Prezime: '.$custom['rezervacija_info_prezime'][0].'</p>';
    }
  }
  if ( get_post_meta( get_the_ID(), 'rezervacija_info_email', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_email'])) {
     // echo '<p>E-mail: '.$custom['rezervacija_info_email'][0].'</p>';
    }
  }
  if ( get_post_meta( get_the_ID(), 'rezervacija_info_tel_mob', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_tel_mob'])) {
     //echo '<p>Tel/Mob: '.$custom['rezervacija_info_tel_mob'][0].'</p>';
    }
  } if ( get_post_meta( get_the_ID(), 'rezervacija_info_check_in', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_check_in'])) {
     // echo '<p>Datum dolaska: '.$custom['rezervacija_info_check_in'][0].'</p>';
    }
  }
  if ( get_post_meta( get_the_ID(), 'rezervacija_info_check_out', true ) ) {
    $custom = get_post_custom();
    if(isset($custom['rezervacija_info_check_out'])) {
     // echo '<p>Datum odlaska: '.$custom['rezervacija_info_check_out'][0].'</p>';
    }
  }

echo '<div class= "container containercard" style="margin-top:3%; margin-left: 25%;">
<div class="card mb-3" style="width: 50rem; text-align: center;"> 
<div class="row"> 
<div class="card mb-3" style="width: 37rem; height: 40.7rem; margin-top: 3%; margin-left: 13%; text-align: center; ">
<div class="card-body" style="margin-top: 5%;">';
the_post();
the_title('<h3 style="text-align: center; margin-left: 2%; margin-bottom: 7%">', '</h3>');
the_content();
echo' <h3 style="text-align: center; margin-left: 2%; margin-bottom: 7%">Zahvaljujemo na rezervaciji!</h3></p>
<p class="card-text" style="font-size: 12px;">Ime hotela: '.$custom['rezervacija_info_hotel'][0].'</p>
<p class="card-text" style="font-size: 12px;">Tip sobe: '.$custom['rezervacija_info_soba'][0].'</p>
<p class="card-text" style="font-size: 12px;">Ime: '.$custom['rezervacija_info_ime'][0].'</p>
<p class="card-text" style="font-size: 12px;">Prezime: '.$custom['rezervacija_info_prezime'][0].'</p>
<p class="card-text" style="font-size: 12px;">E-mail: '.$custom['rezervacija_info_email'][0].'</p>
<p class="card-text" style="font-size: 12px;">Tel/Mob: '.$custom['rezervacija_info_tel_mob'][0].'</p>
<p class="card-text" style="font-size: 12px;">Datum dolaska: '.$custom['rezervacija_info_check_in'][0].'</p>
<p class="card-text" style="font-size: 12px;">Datum odlaska: '.$custom['rezervacija_info_check_out'][0].'</p> </div>
</div>
</div>
</div>
</div>';

}
}
?>
<?php
get_footer();
?>
