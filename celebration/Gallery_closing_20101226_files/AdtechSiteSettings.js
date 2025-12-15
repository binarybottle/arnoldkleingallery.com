/* ==================================================================== */
/* Defines Site settings for Adtech                       */
/* ==================================================================== */

var adtech_selected =1; //If site uses Adtech then value should be "1" else if it uses OAS then it should be "0"
var adtech_throttle = 4;//This variable controls the flow of adtech calls:0 = none;1 = 25%;2 = 50%;3 = 75%;>3 = 100%
var adtechserver = "gannett.gcion.com"; //Adtech Server Name
var adtechnetworkid =  5111.1; //5071.21 //Adtech Network ID
var adtech_keyvalue_Array= new Array(
"car",
"majorevent"
); //Array should consist of all defined keys or words which can be targetted using adtech 
/* ==================================================================== */
/* Defines site settings for CheckM8                       */
/* ==================================================================== */
var checkM8_site_control = "1"; //"1" to turn on the checkM8 calls and "0" to turnoff the checkM8 calls per site 
var adtechdefaultplacement = 896060;  //Default ad placement when primary ad targeting criteria is not found
