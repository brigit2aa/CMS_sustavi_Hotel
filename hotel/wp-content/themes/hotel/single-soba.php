
<?php 
get_header();

?> 


<main>
	<div style="margin-bottom: 6%;">

    <div class= "container containercard" style="margin-top:3%;">
      <div class="card mb-3" style="width: 83rem; text-align: center; "> 
       <div class="row">  
        <?php 



        if ( have_posts() )
        {
        while ( have_posts() )
            {
               //the_title('<h3 style="text-align: left; text-decoration: underline; margin-left: 2%; color: gray; margin-top: 2%;">', '</h3>');
               the_post();
               the_content();
               //Ispisujem taksonomiju kategorije
              $sTerms = get_the_terms( $post->ID , 'tip_sobe' );
              if ( $sTerms != null ){
                foreach( $sTerms as $term ) {
                  //echo '<div><p >'.$term->name.'</p></div>';
                }
              }
              //Dohvačam sliku
              $thumbnail_url = get_the_post_thumbnail_url($post->ID);

              if ( get_post_meta( get_the_ID(), 'soba_info_cijena', true ) ) {
                $custom = get_post_custom();
                if(isset($custom['soba_info_cijena'])) {
                 //echo '<p>E-mail: '.$custom['soba_info_cijena'][0].'</p>';
                }
              } if ( get_post_meta( get_the_ID(), 'soba_info_broj_osoba', true ) ) {
                $custom = get_post_custom();
                if(isset($custom['soba_info_broj_osoba'])) {
                 // echo '<p>Adresa: '.$custom['soba_info_broj_osoba'][0].'</p>';
                }
              }

             echo ' <div class="card mb-3" style="width: 30rem; height: 36rem; margin-top: 1.3%; margin-left: 5%;">
              <div class="card-body" style="margin-top: 5%;">';
              the_title('<h3 style="text-align: center; margin-left: 2%; margin-top:15%;">', '</h3>');
              echo '<p class="card-text"  style="size: 5px; ">Broj kreveta: '.$term->name.'</p>           
              <img class="" style="width: 280px; height: 190px ;" src='.$thumbnail_url.' alt="...">
              <p class="card-text" style="font-size: 12px;">Cijena za '.$custom['soba_info_broj_osoba'][0].' osobu/e</p>
              <p class="card-text" style="font-size: 12px;">Cijena za jedno nočenje: '.$custom['soba_info_cijena'][0].' € </p>

              </div>
              </div>';
            }
          } 
              ?>
              
              <?php
              
             $args = array(
                'post_type' => 'hotel',
                'orderby' => 'rand',
                'post_status' => 'publish',
                'order' => 'DESC',
                'post_per_page'   => -1,
                );

                    $hoteli = get_posts( $args );
                    foreach ($hoteli as $hotel)
            {
              
               $sHotelNaziv = $hotel->post_title;
            }
            
              ?>
              <div class="card mb-3" style="width: 45rem; margin-left: 5%; margin-top: 1.3%; margin-bottom: 2%;">
              <div class="card-body">
              <div class="card-body">
              <form action="" method="POST"  >
              
              <input type="text" class="form-control" id="rezervacija_info_hotel" placeholder="Hotel..." value="<?php echo $sHotelNaziv; ?>" name ="idHotel">
              </br>
              <input type="text" class="form-control" id="rezervacija_info_soba" value="<?=the_title();?>"  name ="idSoba"> <!--Stavila sam da input bude nevidljiv = type="hidden". U inputu dohvačam naziv sobe-->
              </br>
              <input type="text" class="form-control" id="rezervacija_info_ime" placeholder="Ime..." name ="ime">
              </br>
              <input type="text" class="form-control" id="rezervacija_info_prezime" placeholder="Prezime..." name="prezime">
              </br>
              <input type="email" class="form-control" id="rezervacija_info_email" placeholder="E-mail..." name="email">
               </br>
              <input type="text" class="form-control" id="rezervacija_info_tel_mob" placeholder="Tel/Mob..." name="telefon">
              </br>
              <label>Datum dolaska:</label>
              <input type="date" class="date-data" id="rezervacija_info_check_in" placeholder="dd-mm-yyyy" name="datumod">
              </br>
              </br>
              <label>Datum odlaska:</label>
              <input type="date" class="date-data" id="rezervacija_info_check_out" placeholder="dd-mm-yyyy" name="datumdo">
              </br>
              </br>
              <input type="submit" id="podaci" class="btn btn-dark" value="Rezerviraj" name="rezer"> 
              
              </form>
              <?php 
            
              
              ?>
              <?php
             

              if(isset($_POST['rezer'])){
                  $ime = $_POST['ime'];
                  $prezime = $_POST['prezime'];
                  $email = $_POST['email'];
                  $telefon = $_POST['telefon'];
                  $datumod = $_POST['datumod'];
                  $datumdo = $_POST['datumdo'];
                  $idHotel = $_POST['idHotel'];
                  $idSoba = $_POST['idSoba'];
                  
                  global $wpdb;
                  $sql2 = $wpdb->get_var("SELECT count(*) FROM wp_podaci_o_klijentu  WHERE idHotel='$idHotel' and idSoba='$idSoba'");
                  if($sql2<5){
                    global $wpdb;
                    $sql =$wpdb->insert("wp_podaci_o_klijentu", array(
                      "ime" => $ime,
                      "prezime" => $prezime,
                      "email" => $email,
                      "telefon" => $telefon,
                      "datumod" => $datumod,
                      "datumdo" => $datumdo,
                      "idHotel" => $idHotel,
                      "idSoba" => $idSoba 
                    ));
                      
                    if($sql == true){
                      
                      echo "<script>alert('Uspješno ste upisali podatke.')</script>";
                      
                      ?>
                      <?php 
                      if($_POST){
                        $agrs = array(
                          'post_type' => 'rezervacija',
                          'post_status' => 'publish'
                        );
                        
                        $query = wp_insert_post($agrs, true); 
                        add_post_meta($query, 'rezervacija_info_ime', $_POST['ime']);
                        add_post_meta($query, 'rezervacija_info_prezime', $_POST['prezime']);
                        add_post_meta($query, 'rezervacija_info_email', $_POST['email']);
                        add_post_meta($query, 'rezervacija_info_tel_mob', $_POST['telefon']);
                        add_post_meta($query, 'rezervacija_info_check_in', $_POST['datumod']);
                        add_post_meta($query, 'rezervacija_info_check_out', $_POST['datumdo']);
                            //
                        add_post_meta($query, 'rezervacija_info_hotel',  $_POST['idHotel']);//
                        add_post_meta($query, 'rezervacija_info_soba', $_POST['idSoba']);//
                            //
                        wp_set_object_terms( $query, $_POST['ime'] . ' ' .  $_POST['prezime'], 'osoba' );
                        wp_set_object_terms( $query, ' Datum dolaska: '. $_POST['datumod'] . ' Datum odlaska: '.  $_POST['datumdo'], 'datum' );
                      }
                      ?>
                      
                      <?php
                      echo daj_rezervaciju();
                    }
                  }
                  else{
                    echo "<script>alert('Hotel nema slobodnih soba željene kategorije. Moliko odaberite drugu kategoriju.')</script>";
                  }
               
              }
         
        
                ?>
             <script>
              $(function(){
                $('#idbuton').trigger("click"); 
              });
             </script>
               <?php
             
              ?>
              <?php
              ?>
              <?php
              ?>
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>     
        </div>     
      </main>
<?php
get_footer(); 
?>
