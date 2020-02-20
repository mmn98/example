function select_all(obj) {
    if ($(obj).is(":checked")) {
        $(".check_multiple").prop('checked', true);
    } else {
        $(".check_multiple").prop('checked', false);
    }
}

function check_select() {
    var count = $(".check_multiple:checked").length;

    if (count > 0) {
        return true;
    } else {
        
        return false;
    }
}

function multi_delete()
{

    var result=check_select();
    if(result)
        {
                var allows = document.getElementsByClassName('check_multiple');
                var ids = [];

                $('input[class="check_multiple"]:checked').each(function() {
                ids.push(this.value); 
                });
              alert(ids);
            

            
                if(confirm('Are you sure you want to delete this record?'))
                    {
                        $.ajax({
                            url: '../users/multidelete.php',
                            type: 'POST',
                            data: { id: ids },
                            success: function(response) {
                                  //  alert(response);
                                $.each(ids, function (i) {
                                $('#users_'+ids[i]).remove();
                                $('#alert p').text(response);
                               $('#alert').css('display', 'block');

                            });
                        

                            },
                        });
                }  
        }
        else
        {
            alert('Please select record(s) to delete');
        }  
}