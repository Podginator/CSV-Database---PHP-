$(function() {


    //For the
    $(".hoverable").mousemove(function( e ) {
        var hiddenBox = $(".hidebox"),
            x = e.clientX,
            y = e.clientY;
        hiddenBox.css("top",y+5+"px");
        hiddenBox.css("left",x+5+"px");
    });

    function UrlParameter(Param)
    {
        var PageURL = window.location.search.substring(1);
        var URLVars = PageURL.split('&');
        for (var i = 0; i < URLVars.length; i++)
        {
            var ParameterName = URLVars[i].split('=');
            if (ParameterName[0] == Param)
            {
                return ParameterName[1];
            }
        }
    }

    function handleCSV(evt)
    {
        var files = evt.target.files; //FileList
        var fileExt=/\.[0-9a-z]+$/i;
        var upload = $("#upload");
        var box = document.getElementById('filepreview');
        var upBox = document.getElementById("hiddenText");

        if(files[0].name.match(fileExt) != '.csv')
        {
            box.value = 'Not a CSV File, please reupload a file.';
            upload.val("");
            upBox.value = "";
            return false;
        }
        else
        {
            var reader = new FileReader();

            reader.onload = function(e) {
                var check = checkCSVFormat(reader.result);
                
                
                if(check == "Invalid CSV Format")
                {
                    upload.val("");
                    upBox.value = "";
                }
                box.value = check;
                upBox.value = reader.result;
            };
            reader.readAsText(files[0]);
        }

    }

    function checkCSVFormat(csv)
    {
        var res = "";
        var unpacked = csv.split("\n");

        console.log("Unpacked Length :: "  + unpacked.length);
        for(i=0; i != unpacked.length; i++)
        {
            var lineSplit = unpacked[i].split(",")
            console.log(lineSplit.length);
            if(lineSplit.length == 4)
            {
                if(!isNaN(lineSplit[0]) && !isNaN(lineSplit[1]))
                {
                    res += "Course ID: " 
                    res += lineSplit[0] + " Student ID:"; 
                    res += " " +lineSplit[1] + " Group:";
                    res += " " + lineSplit[2] + " Grade:"
                    res += " " + lineSplit[3] + "\n";
                }
                else
                {
                    return "Invalid CSV Format";
                }
            }
            else
            {
                return "Invalid CSV Format";
            }

        }


        return res;
    }


    $(".sortable").each(function(ind){
        var getParam = window.location.href;
        var getRelevant = UrlParameter("sort");
        console.log(getParam);

        if(getParam.indexOf("o=1") != -1)
        {
            if(($(this).find("a").attr("href")).indexOf(getRelevant) != -1)
            {
                $(this).find("a").attr("href", ($(this).find("a").attr("href")).replace("o=1","o=0"));
                $(this).addClass("down");
                $(this).removeClass("up");
            }
        }
        else if(getParam.indexOf("o=0") != -1)
        {
            if(($(this).find("a").attr("href")).indexOf(getRelevant) != -1)
            {
                $(this).find("a").attr("href", ($(this).find("a").attr("href")).replace("o=0","o=1"));
                $(this).addClass("up");
                $(this).removeClass("down");

            }
        }

    });

    $(document).on('change', 'input[type="file"]', handleCSV);



    $('select').on('change', function (e) {
        var option = $("option:selected", this);
        var val = this.value;
        var id = $(this).attr("id");
        var loc = window.location;
        var $filt = $('.filters').find("a").attr("href");
        //alert(location.pathname);
        window.location.href = ($filt + id + "/" + val);

    });






});
