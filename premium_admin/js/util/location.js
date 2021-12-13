function getCountries()
{
    
    $.ajax({
           url: "./web-services/location/getCountryList",
           type:"GET",
           dataType: "json",
           async:false,
           success: countryList,
           error:function(){
                
           }
    });
}


function getStateList(country_id)
{
    
    $.ajax({
           url: "./web-services/location/getStateList?country_id="+country_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: stateList,
           error:function(){
                
           }
    });
}

function getreligion()
{
    $.ajax({
           url: "./web-services/location/getReligionList",
           type:"GET",
           dataType: "json",
           async:false,
           success: religionList,
           error:function(){
                
           }
    });
}


function getStateList(country_code)
{
    
    $.ajax({
           url: "./web-services/location/getStateList?country_code="+country_code,
           type:"GET",
           dataType: "json",
           async:false,
           success: stateList,
           error:function(){
                
           }
    });
}
function getCasteList(religion_id)
{
    
    $.ajax({
           url: "./web-services/location/getCasteList?religion_id="+religion_id,
           type:"GET",
           dataType: "json",
           async:false,
           success: casteList,
           error:function(){
                
           }
    });
}

