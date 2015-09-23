<?php
/**
 * Created by PhpStorm.
 * User: Nitesh
 * Date: 9/17/2015
 * Time: 4:23 PM
 */
print_r($profiles_data);
echo form_open('profiles'); ?>
      <input type="text"  name="first_name" placeholder=" First Name<?php /*echo $profiles_data[profiles_first_name];*/?>" > </br>
      <input type="text"  name="last_name" placeholder="Last Name"> </br>
     <input type="hidden"  name="todo" value="hlm8734" > </br>

<input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php  echo form_open_multipart('profiles'); ?>
      <input type="file"    name="image" > </br>
      <input type="hidden"  name="todo" value="hlm34523" > </br>
      <input type="submit"  name="submit" value="submit" > </br>
<?php echo form_close(); ?> </br>

<?php echo form_open('profiles'); ?>
        <input type="text" id="txtPlaces"  name="address"  placeholder="Address"> </br>
        <input type="text" id="pincode"  name="pin" placeholder="Pin"> </br>
        <input type="text" id="state"  name="state" placeholder="State"> </br>
        <input type="text" id="country"  name="country" placeholder="Country"> </br>
        <input type="hidden"  name="todo"  value="hlm23413"> </br>
<input type="submit"  name="submit" value="submit" >

<?php echo form_close(); ?> </br>






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
