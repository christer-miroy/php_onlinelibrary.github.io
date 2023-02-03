<script>
    /* will only run when the document is ready */
    //to show existing data from the db table

    /* show */
    $(document).ready(function(){
        $.ajax({
            //attributes
            url:"show.php", //file sql
            type: "POST",
            cache: false, //save info in the form; only boolean values
            success: function(data) {
                $('#table').html(data);
            }//to be executed once condition is stated
        })

        /* add new book id: add_save*/
        //button i - event - function
        $('#add_save').on('click', function() {
            //variables that will contain values from input field
            var add_title = $('#add_title').val();
            var add_author = $('#add_author').val();
            var add_date = $('#add_date').val();
            var add_pub = $('#add_pub').val();
            var add_genre = $('#add_genre').val();

            if (add_title != "" && add_author != "" && add_date != "" && add_pub != "" && add_genre != "") {
                $.ajax({
                    //attributes
                    url:"add.php", //file sql
                    type: "POST",
                    cache: false, //save info in the form; only boolean values
                    data: {
                        //array containing the key value pairs
                        add_title : add_title,
                        add_author : add_author,
                        add_date : add_date,
                        add_pub : add_pub,
                        add_genre : add_genre
                    },
                    success: function(dataResult) {
                        var data = JSON.parse(dataResult);

                        if (data.statusCode == 200) {
                            /* okay */
                            alert("Book added successfully.");
                            location.reload(); //closes the modal, refresh the page and display the new item
                        } else if (data.statusCode === 201){
                            /* error */
                            alert("Error!");
                        } 
                    }
                })
            } else {
                alert("Fields are empty.");
            }
        });

        /* view book */
        $(function(){
            $('#view_modal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var view_title = button.data('title');
                var view_author = button.data('author');
                var view_date = button.data('date');
                var view_pub = button.data('pub');
                var view_genre = button.data('genre');
                var modal = $(this);
                modal.find('#view_title').val(view_title);
                modal.find('#view_author').val(view_author);
                modal.find('#view_date').val(view_date);
                modal.find('#view_pub').val(view_pub);
                modal.find('#view_genre').val(view_genre);
            })
        });

        /* edit book - show details */
        $(function(){
            $('#edit_modal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var edit_id = button.data('id');
                var edit_title = button.data('title');
                var edit_author = button.data('author');
                var edit_date = button.data('date');
                var edit_pub = button.data('pub');
                var edit_genre = button.data('genre');
                var modal = $(this);
                modal.find('#edit_id').val(edit_id);
                modal.find('#edit_title').val(edit_title);
                modal.find('#edit_author').val(edit_author);
                modal.find('#edit_date').val(edit_date);
                modal.find('#edit_pub').val(edit_pub);
                modal.find('#edit_genre').val(edit_genre);
            })
        });

        /* edit book - update details */
        $(document).on('click', '#edit_save', function() {
            $.ajax({
                url: "edit.php",
                type: "POST",
                cache: false,
                data: {
                    edit_id: $('#edit_id').val(),
                    edit_title: $('#edit_title').val(),
                    edit_author: $('#edit_author').val(),
                    edit_date: $('#edit_date').val(),
                    edit_pub: $('#edit_pub').val(),
                    edit_genre: $('#edit_genre').val()
                },
                success: function(dataResult) {
                    var data = JSON.parse(dataResult);

                    if (data.statusCode == 200) {
                         /* okay */
                        alert("Changes saved successfully.");
                        location.reload(); //closes the modal, refresh the page and display the new item
                    }
                }
            })
        });

        /* delete button */
        $(document).on('click', '#delete', function() {
            var $rowToDelete = $(this).parent().parent(); //delete whole row
            $.ajax({
                url: "delete.php",
                type: "POST",
                cache: false,
                data: {
                    delete_item: $(this).attr('data-id')
                },
                success: function(dataResult) {
                    var data = JSON.parse(dataResult);

                    if (data.statusCode == 200) {
                         /* okay */
                        location.reload(); //closes the modal, refresh the page and display the new item
                        $rowToDelete.fadeOut();
                    }
                }
            })
        });

        /* search function */
        $(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#table tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    /* overall closing */
    });
</script>