$(document).ready(function(){
    $('#search').keyup(function(){
        var searchText = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'post',
            data: {query: searchText},
            success: function(response){
                $('#result').html(response);
            }
        });
    });
});
