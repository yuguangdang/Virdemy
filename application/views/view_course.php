<main style="min-height: 100vh">
    <div class="container d-flex">
        <div class="py-2">
            <video class="rounded" width="854" height="480" controls>
                <source src=<?php echo base_url() . "uploads/" . $video ?> type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class=" text-center my-2 py-1 ml-2 rounded sticky" style="background-color: #2E5E4E; flex-grow: 1;">
            <p style="color: #FEFBE9">Course content</p>
            <?php foreach ($videos as $video) { ?>
                <div class="row mx-1 my-1 py-1 video align-items-center">
                    <div class="col" id="<?php echo $video['video_id'] ?>">
                        <?php echo $video['filename'] ?>
                    </div>
                    <div class="col">
                        <a href=<?php echo base_url() . "course/view_course/" . $course_id . "/" . $video['video_id'] ?>><i class="fa-regular fa-circle-play"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container mt-0">

        <div class="rounded p-2 mt-2" style="background-color: #fdfbe9;">
            <h3 class="my-3" style="color: #2E5E4E">Q&A Section</h3>

            <?php echo form_open('ajax', 'autocomplete="off"'); ?>
            <div>
                <input class="form-control mr-sm-2" type="search" id="search_text" placeholder="Search questions for this course" name="search" aria-label="Search">
            </div>
            <div id="auto_complete" style="background: white;"></div>
            <input type="hidden" id="start" value="0">
            <input type="hidden" id="rowperpage" value="3">
            <input type="hidden" id="totalrecords" value="<?= $total_questions ?>">
            <?php echo form_close(); ?>
            <button type="submit" class="button" id="question">Ask a question</button>


            <hr style="background-color: grey">

            <?php echo form_open_multipart(base_url() . 'question', array('id' => 'question_form')); ?>
            <br>
            <div class="form-group row">
                <label class="col-3" for="">Question title</label>
                <input class="col-8" type="text" class="form-control" required="required" name="question_title" required="required">
            </div>
            <div class="form-group row">
                <label class="col-3" for="">Question content</label>
                <textarea class="col-8" name="question_content" id="" cols="30" rows="5" required="required"></textarea>
            </div>
            <div hidden class="form-group row">
                <input type="text" name="course_id" value="<?php echo $this->uri->segment('3'); ?>">
                <input type="text" name="video_id" value="<?php echo $this->uri->segment('4'); ?>">
            </div>
            <div class="form-group">
                <button type="submit" value="creatQuestion" class="button">Create question</button>
            </div>
            <?php echo form_close(); ?>

            <div id="result"></div>

        </div>
    </div>
</main>

<script>
    $(document).ready(function() {

        var question_form = document.getElementById("question_form");
        var question_button = document.getElementById("question");
        question_form.style.display = "none";

        // Display and hide ask a question section
        $("#question").click(function() {
            if (question_form.style.display == "none") {
                question_form.style.display = "block";
                question_button.innerHTML = "All questions";
            } else {
                question_form.style.display = "none";
                question_button.innerHTML = "Ask a question";
            }
        });

        // Highlight the video which is in play.
        var url = window.location.href;
        var video_id = url.split('/').pop();
        var active_video = document.getElementById(video_id).parentElement;
        active_video.classList.add("video_active");

        // Auto-complete funciton

        var search_terms = ['javascript', 'html', 'css',  'php', 'codeigniter', 'sql', 'nodeJS', 'express', 'mongoDB',  'python', 'flask', 'django', 'bootstrap', 'cloud', 'computing',  'AWS', 'Aure', 'GCP', 'Hadoop'];
 
        function autocompleteMatch(input) {
            if (input == '') {
                return [];
            }
            var reg = new RegExp(input)
            return search_terms.filter(function(term) {
                if (term.match(reg)) {
                return term;
                }
            });
        }
 
        function showResults(val) {
            auto_complete = document.getElementById("auto_complete");
            auto_complete.innerHTML = '';
            let list = '';
            let terms = autocompleteMatch(val);
            for (i=0; i<terms.length; i++) {
                list += "<li class='item'>" + terms[i] + '</li>';
            }
            auto_complete.innerHTML = '<ul>' + list + '</ul>';
            let search_text = document.getElementById('search_text');
            document.querySelectorAll('.item').forEach(item => {
                item.addEventListener('click', event => {
                    search_text.value = item.innerHTML; 
                    load_data(search_text.value);
                    auto_complete.innerHTML = '';
                })
            })
        }

        // AJAX function.
        load_data();

        window.addEventListener('scroll', scroll_to_load) ;

        function scroll_to_load() {
            localStorage.setItem('pageVerticalPosition', window.scrollY);
            if (Math.abs(window.innerHeight + window.scrollY - document.body.offsetHeight) < 1) {
                console.log("Reached the bottom of the page.")
                load_data();
            }
        }

        document.querySelector("#search_text").addEventListener("input", function() {
            var search = $(this).val();
            showResults(search);
            if (search != '') {
                load_data(search);
                window.removeEventListener("scroll", scroll_to_load);
            } else {
                $('#start').val(0);
                window.addEventListener('scroll', scroll_to_load) ;
                load_data();
            }
        })

        function load_data(query) {

            var start = Number($('#start').val());
            var totalrecords = Number($('#totalrecords').val());
            var rowperpage = Number($('#rowperpage').val());
            start = start + rowperpage;
            if (start > totalrecords) {
                start = totalrecords;
            }

            console.log(start);
            console.log(rowperpage);
            console.log(totalrecords);

            if(start <= totalrecords){
                $('#start').val(start);

                $.ajax({
                url:"<?php echo base_url(); ?>ajax/fetch",
                method:"GET",
                data:{query:query, start:start},
                success: function(response) {
                    $('#result').html("");
                    if (response == "" ) {
                        $('#result').html(response);
                    }else{
                        var items = [];
                        var obj = JSON.parse(response);
                        $.each(obj, function(i, val) {
                            items.push($("<h5>").text(val.question_title));
                            items.push($("<p>").text(val.question_content));
                            items.push($("<p style='color: gray'>").text(val.creator_name + "    " + val.create_time.substring(0, 7)));
                            items.push($("<hr>"));
                        });
                        $('#result').append.apply($('#result'), items);
                    }
                }
            })
            }
        }
    });

</script>