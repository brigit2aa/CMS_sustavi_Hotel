<?php 
get_header();
?>

<main>
	<div >
        <?php 
        if ( have_posts() )
        {
        while ( have_posts() )
            {
               //the_title('<h3 style="text-align: left; text-decoration: underline; margin-left: 2%; color: gray; margin-top: 2%;">', '</h3>');
               the_post();
               the_content();
               //Ispisujem taksonomiju kategorije
              $sTerms = get_the_terms( $post->ID , 'kategorija_hotela' );
              if ( $sTerms != null ){
                foreach( $sTerms as $term ) {
                  //echo '<div><p >'.$term->name.'</p></div>';
                }
              }


             

              //Dohvačam sliku
              $thumbnail_url = get_the_post_thumbnail_url($post->ID);

              if ( get_post_meta( get_the_ID(), 'kontakt_info_karta', true ) ) {
                $custom = get_post_custom();
                if(isset($custom['kontakt_info_karta'])) {
                 //echo '<h5>E-mail: '.$custom['kontakt_info_karta'][0].'</h5>';
                }
              } if ( get_post_meta( get_the_ID(), 'kontakt_info_adresa', true ) ) {
                $custom = get_post_custom();
                if(isset($custom['kontakt_info_adresa'])) {
                 // echo '<h5>Adresa: '.$custom['kontakt_info_adresa'][0].'</h5>';
                }
              }
             
                if ( get_post_meta( get_the_ID(), 'kontakt_info_adresa', true ) ) {
                  $custom = get_post_custom();
                  if(isset($custom['kontakt_info_telefon'])) {
                    //echo '<h5>Telefon: '.$custom['kontakt_info_telefon'][0].'</h5>';
                  }
                }
                  if ( get_post_meta( get_the_ID(), 'kontakt_info_email', true ) ) {
                    $custom = get_post_custom();
                    if(isset($custom['kontakt_info_email'])) {
                      //echo '<h5>E-mail: '.$custom['kontakt_info_email'][0].'</h5>';
                    }
                  }
              echo '<div class= "container containercard" style="margin-top:3%;">
              <div class="card mb-3" style="width: 83rem; text-align: center; "> 
              <div class="row"> 
              
              <div class="card mb-3" style="width: 30rem; height: 30.7rem; margin-top: 1.3%; margin-left: 5%;">
              <div class="card-body" style="margin-top: 5%;">';
              the_title('<h3 style="text-align: center; margin-left: 2%; ">', '</h3>');
              echo '<p class="card-text"  style="size: 5px; ">'.$term->name.'</p>
              <img class="" style="width: 380px; height: 210px ;" src='.$thumbnail_url.' alt="...">
              <h5 class="card-title" style="margin-top: 2%;">Kontakt</h5>
              <p class="card-text" style="font-size: 12px;">Adresa: '.$custom['kontakt_info_adresa'][0].'</p>
              <p class="card-text" style="font-size: 12px;">Telefon: '.$custom['kontakt_info_telefon'][0].'</p>
              <p class="card-text" style="font-size: 12px;">E-mail: '.$custom['kontakt_info_email'][0].'</p>
              </div>
              </div>
              
              <div class="card mb-3" style="width: 41rem; margin-left: 5%; margin-top: 1.3%; margin-bottom: 2%;">
              <div class="card-body"><iframe src="'.$custom['kontakt_info_karta'][0].'"></iframe>
              </div>
             
              </div>
             
              </div>
              </div>
              </div>';

              echo '<div class= "container containercard" style="margin-top:3%;">
              <div class="card mb-3" style="width: 83rem; text-align: center; "> 
              <div class="row">
              <div class="card mb-3" style="width: 79.5rem; margin-left: 3%; margin-top: 1.3%;  height: 9rem; 2%; text-align: center;">
              <h5 class="card-title" style="margin-top: 2%; margin-bottom: 2%;">Usluge hotela</h5><div> ';
             $sTermsUsluga = wp_get_post_terms( $post->ID, 'usluga_hotela' ); 
             foreach( $sTermsUsluga as $termUsluga ) {
               echo  $termUsluga->slug . '<ul class="card-text" style="font-size: 12px;  display: inline; "></ul> '; 
             }
              echo '</div></div> 
              </div>
              </div>
              </div>
             ';
            }
            echo daj_sobe();
          } 
        ?>
	</div>
  
</main>
<?php
get_footer(); 
?>