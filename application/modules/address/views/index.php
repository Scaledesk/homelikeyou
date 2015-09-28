<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/26/2015
 * Time: 4:09 PM
 */

?>


<?php echo form_open('address'); ?>
<input type="text" id="txtPlaces"    name="address_street"    placeholder="Address">      </br>
<input type="text" id="home_no"      name="address_hno"       placeholder="Home">         </br>
<input type="text" id="city"         name="address_city"      placeholder="City">         </br>
<input type="text" id="state"        name="address_state"     placeholder="State">        </br>
<input type="text" id="country"      name="address_country"   placeholder="Country">      </br>
<input type="text" id="zip"          name="address_zip"       placeholder="Zip  Code">    </br></br></br>
<input type="text" id="id"          name="address_id"       placeholder=" foreign key Id">    </br>
<input type="submit"                 name="submit"   value="submit" >

<?php echo form_close(); ?>






<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
        google.maps.event.addListener(places, 'place_changed', function () {
            var place = places.getPlace();
            var address = place.formatted_address;
            var latitude = place.geometry.location.H;
            var longitude = place.geometry.location.L;
            var mesg = "Address: " + address;

            console.log(place.address_components.length);
            console.log(place.address_components[3]['long_name']);
            //var array = JSON.parse("[" + address + "]");
            //var conutry=place.country-name;
            //var address = place.address_components;
            mesg += "\nLatitude: " + latitude;
            mesg += "\nLongitude: " + longitude;
            // alert(place);
            var getCountry;
            var getState;
            // var getPincode;
            // console.log(place)
            /*.......................................................*/
            for (var i = 0; i < place.address_components.length; i++)
            {
                var addr = place.address_components[i];

                if (addr.types[0] == 'country') {
                    getCountry = addr.long_name;
                }
                if(addr.types[0]=='administrative_area_level_1'){
                    getState = addr.long_name;
                }

                if(addr.types[0]=='postal-code'){
                    getPincode=addr.postal-code;
                }
            }

            //alert(getCountry);

            document.getElementById("state").value= getState;
            document.getElementById("country").value= getCountry;
            //document.getElementById("pincode").value= getPincode;
            /*..................................................................*/

        });
    });
</script>
