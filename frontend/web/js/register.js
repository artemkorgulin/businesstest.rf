var region     = null;
var schoolName = null;
var schoolid   = null;
var classid    = null;

function reload()
{

    $.ajax({
        method: "get",
        url:    "?r=reg/school-control",
        data: {
            "region": region,
            "schoolName": schoolName,
            "school": schoolid,
            "class": classid
        },
        cache: false,
        success: function (ht) {
            $('#school-selection-default').html(ht);

            if($('#schoolcontrol-schoolselected option').length==1 && $('[data-role=class-id-select]').length==0 ){
                schoolid = $('[data-role="school-id-select"]').val();
                console.log(schoolid);
                $('#currentSchool').val(schoolid);
                reload();
            }
        }
    });
}
$(document).on('change', '[data-role="region-level-select"]', function(){
    region = $(this).val();
    schoolName = null;
    schoolid   = null;
    if (region.indexOf('[') + 1 > 0) region = region.split('[')[0];
    $('#currentRegion').val(region);
    $('#currentSchool').val(null);
    $('#currentClass').val(null);
    reload();
});

$(document).on('change', '[data-role="school-name-select"]', function(){
    schoolName = $(this).val();
    schoolid = null;
    reload();

});

$(document).on('change', '[data-role="school-id-select"]', function(){
    schoolid = $(this).val();
    $('#currentSchool').val(schoolid);
    reload();
});





$(document).on('change', '[data-role="class-id-select"]', function(){
    classid = $(this).val();
    $('#currentClass').val(classid);
    reload();
});

$(document).ready(function(){
    region   = $('#currentRegion').val();
    schoolid = $('#currentSchool').val();
    classid  = $('#currentClass').val();
});
