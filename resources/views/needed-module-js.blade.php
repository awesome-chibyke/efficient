<script>

    function getRequest(url){

        return new Promise(function (resolve, reject) {

            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then(res => res.json())
                .then(data => resolve(data))
                .then(err => reject(err));

        });
    }

    function postRequest(url, params){

        return new Promise(function (resolve, reject) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post(url, params, function (data, status) {

                if(status === 'success'){
                    resolve(data)
                }else{
                    reject(status)
                }
            })

        })
    }

    function postRequestData(url, params) {

        return new  Promise(function (resolve, reject) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: params,
                type: 'post',
                success: function(response){
                    resolve(response);
                },
                error: function (error) {
                    reject(error);
                }
            });

        })

    }

    function readData(id_selector, num) {
        return new Promise(function (resolve, reject) {

            const reader = new FileReader();
            reader.readAsDataURL(document.getElementById(id_selector).files[num]);
            reader.onload = function() {
                resolve(reader.result);
            }

        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    //handle error statement
    function handleErrorStatement(error_statement) {
        for(var i in error_statement){
            var txt = '';
            for(var j in error_statement[i]){
                txt += "<p class='f-size'><span class='t-color'>*</span> "+error_statement[i][j]+"</p>";
            }
            if(i === 'general_error'){
                returnFunctions.showSuccessToaster(txt, 'warning');
            }else{
                $('.'+i).html(txt).removeClass('hidden');
            }
        }
    }

    function handleErrorStatement2(error_statement) {
        for(var i in error_statement){
            var txt = '';
            for(var j in error_statement[i]){
                txt += "<p class='f-size'><span class='t-color'>*</span> "+error_statement[i][j]+"</p>";
            }
            if(i === 'general_error'){
                returnFunctions.showSuccessToaster(txt, 'warning');
            }else{
                $('.message').html(txt).removeClass('hidden');
            }
        }
    }

    function handleErrorStatement4(error_statement) {
        returnFunctions.showSuccessToaster(error_statement, 'warning');
    }

    function handleErrorStatement5(error_statement) {
        for(var i in error_statement){
            var txt = '';
            txt += "<p class='f-size'><span class='t-color'>*</span> "+error_statement[i]+"</p>";
            if(i === 'general_error'){
                returnFunctions.showSuccessToaster(txt, 'warning');
            }else{
                $('.'+i).html(txt).removeClass('hidden');
            }
        }
    }

    function buildEmbededLink(selected_url){

        let exploded_url = selected_url.split("=");

        let url = 'https://www.youtube.com/embed/'+exploded_url[1];

        return url;
    }

    // var newDate = new Date();
    // var selectDate = newDate.getFullYear();
    // for (var i = 0; i < selectDate.length; i--){
    //     var mmm = selectDate[i];
    // }
    // console.log(mmm);

    //session select creator
    function sessionSelectCreator(session_array, active_session_id) {

        //loop mthrough the session details
        if(session_array.length > 0){

            let session_options = `<option value="">Select Session</option>`;
            let session_options_array = [];
            for (let i in session_array){
                let {id, unique_id, session_date} = session_array[i];
                if(checkIfInArray(id, session_options_array) == -1) {
                session_options += `
                        <option ${(active_session_id == id)?'selected':''} value="${id}">
                        ${session_date}
                        </option> `;
                    session_options_array.push(id);
                }
            }
            return session_options;

        }

    }


    function createTeacherSelect(teachers_details_array, selected_teacher_id){

        if(teachers_details_array.length > 0){

            let teacher_options = `<option value="">Select Teacher</option>`;
            let teacher_options_array = [];
            for (let i in teachers_details_array){
                let {id, lastname, firstname} = teachers_details_array[i];
                if(checkIfInArray(id, teacher_options_array) == -1) {
                teacher_options += `
                        <option ${(selected_teacher_id == id)?'selected':''} value="${id}">
                        ${capitalizeFirstLetter(lastname)} ${capitalizeFirstLetter(firstname)}
                        </option> `;
                    teacher_options_array.push(id);
                }

            }
            return teacher_options;
        }

    }

    //check if a value is a n array
    function checkIfInArray(theValue, theArray){
        return jQuery.inArray(theValue, theArray);

    }

    function classSelectCreator(all_class_details_array, active_class_id) {

        //loop through the class details
        if(all_class_details_array.length > 0){

            let class_options = `<option value="">Select Class</option>`;
            let class_options_array = [];
            for (let i in all_class_details_array){

                let {class_details_array, class_label_details, class_level_details, class_category_details} = all_class_details_array[i];
                if(checkIfInArray(class_details_array.id, class_options_array) == -1) {
                    class_options += `
                        <option ${(active_class_id == class_details_array.id) ? 'selected' : ''} value="${class_details_array.id}">
                        ${capitalizeFirstLetter(class_label_details.label)}
                        ${capitalizeFirstLetter(class_category_details.category)}
                        (${class_level_details.level})
                        </option>
                    `;
                    class_options_array.push(class_details_array.id);
                }
            }
            return class_options;

        }

    }

    function createTermSelect(terms_details_array, active_term_id) {

        if(terms_details_array.length > 0){

            let term_options = `<option value="">Select Term</option>`;
            let term_options_array = [];
            for (let i in terms_details_array){

                let {id, term} = terms_details_array[i];
                if(checkIfInArray(id, term_options_array) == -1) {
                term_options += `
                        <option ${(active_term_id == id)?'selected':''} value="${id}">
                        ${capitalizeFirstLetter(term)}
                        </option> `;
                    term_options_array.push(id);
                }
            }
            return term_options;

        }

    }

    function createSubjectSelect(subjects_details_array, active_subject_id) {

        if(subjects_details_array.length > 0){

            let subject_options = `<option value="">Select Subject</option>`;
            let subject_options_array = [];
            for (let i in subjects_details_array){

                let {id, unique_id, title} = subjects_details_array[i];
                if(checkIfInArray(id, subject_options_array) == -1) {
                subject_options += `
                        <option ${(active_subject_id == id)?'selected':''} value="${id}">
                        ${capitalizeFirstLetter(title)}
                        </option>`;
                    subject_options_array.push(id);
                }
            }
            return subject_options;


        }

    }

    function validateForPasswordLength(inputFieldId, value){
        $(inputFieldId).on('keyup', function(){
            if($(this).val().length < 6){
                var errMessage = "<p class='f-size'><span class='t-color'>*</span> "+value+" Password must contain at least six characters! </p>";
                $('.message').html(errMessage).removeClass('hidden');
            }
        });
    }

    function activateFileField() {

        $('#assessment_files').click();
        $("#display_file_message").text('')

    }

    function getFileInfo(value) {
        var count = $(value)[0].files.length;

        $(".display_file_message").text(+count+' '+'file(s) has been added')
    }

    function selectElement(id, valueToSelect) {
        let element = document.getElementById(id);
        element.value = valueToSelect;
    }

    function returnDateDetails(returned_date){

        var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var dayStrArray=['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        var d = new Date(returned_date);

        return {theDay:d.getDay(), theDayLetter:dayStrArray[d.getDay()], theDate:d.getDate(), theMonth:d.getMonth(), theMonthLetter:strArray[d.getMonth()], theYear:d.getFullYear()};

    }

    function returnDateDetails_2(returned_date){

        var strArray=['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var dayStrArray=['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];

        var d = new Date(returned_date);

        return dayStrArray[d.getDay()]+', '+d.getDate()+returnSurfixPosition(d.getDate())+' '+strArray[d.getMonth()]+' '+d.getFullYear();
        //return {theDay:d.getDay(), theDayLetter:dayStrArray[d.getDay()], theDate:d.getDate(), theMonth:d.getMonth(), theMonthLetter:strArray[d.getMonth()], theYear:d.getFullYear()};

    }

    function returnSurfixPosition(position_string){

        var theStr = position_string.toString();

        var no_array = {'1':'st', '2':'nd', '3':'rd', '4':'th', '5':'th','6':'th','7':'th','8':'th','9':'th','10':'th', '11':'th','12':'th', '13':'th', '14':'th', '15':'th', '16':'th', '17':'th', '18':'th', '19':'th', '20':'th', '21':'st', '22':'nd', '23':'rd', '24':'th', '25':'th', '26':'th', '27':'th', '28':'th', '29':'th', '30':'th', '31':'st'};

        return no_array[theStr];

    }

    function logoutTeacher() {
        $('.delete-modal').removeClass('hidden');
    }

    function removeLogout() {
        $('.delete-modal').addClass('hidden')
    }

    //handle error statement
    function handleErrorStatement3(error_statement) {
        for(var i in error_statement){
            var txt = '';
            txt += "<p class='f-size'><span class='t-color'>*</span> "+error_statement[i]+"</p>";
            if(i === 'general_error'){
                returnFunctions.showSuccessToaster(txt, 'warning');
            }else{
                $('.'+i).html(txt).removeAttr('hidden');
            }
        }
    }

    //session select creator
    function sessionSelectCreator2(session_array, active_session_id) {

        //loop mthrough the session details
        if(session_array.length > 0){

            let session_options = `<option value="">Select Session</option>`;
            for (let i in session_array){
                let {id, unique_id, session_date} = session_array[i];

                session_options += `
                        <option ${(active_session_id == id)?'selected':''} value="${unique_id}">
                        ${session_date}
                        </option>
                    `
            }
            return session_options;

        }

    }


    function classSelectCreator2(all_class_details_array, active_class_id) {

        //loop through the class details
        if(all_class_details_array.length > 0){

            let class_options = `<option value="">Select Class</option>`;
            let class_options_array = [];
            for (let i in all_class_details_array){

                let {class_details_array, class_label_details, class_level_details, class_category_details} = all_class_details_array[i];

                if(checkIfInArray(class_details_array.id, class_options_array) == -1) {
                    class_options += `
                        <option ${(active_class_id == class_details_array.id) ? 'selected' : ''} value="${class_details_array.unique_id}">
                        ${capitalizeFirstLetter(class_label_details.label)}
                        ${capitalizeFirstLetter(class_category_details.category)}
                        (${class_level_details.level})
                        </option>
                    `
                    class_options_array.push(class_details_array.id);
                }else{
                    continue;
                }

            }
            return class_options;

        }

    }

    function createTermSelect2(terms_details_array, active_term_id) {

        if(terms_details_array.length > 0){

            let term_options = `<option value="">Select Term</option>`;
            for (let i in terms_details_array){

                let {id, unique_id, term} = terms_details_array[i];

                term_options += `
                        <option ${(active_term_id == id)?'selected':''} value="${unique_id}">
                        ${capitalizeFirstLetter(term)}
                        </option>
                    `
            }
            return term_options;

        }

    }

    function setLocalStorage(name, value) {
        localStorage.setItem(name, value);
    }

    function getLocalStorage(value) {
        localStorage.getItem(value)
    }

    function declinePrompt(value) {
        $(value).removeClass('hidden')
    }

    function removeDeclinePrompt(value) {
        $(value).addClass('hidden')
    }

    //function that get the ranked students in subject and displays the rank
    function callGetRank() {

        var selected = $('.result-values-hold tr');

        var total_array = [];
        for(var i = 0; i < selected.length; i++){

            total_array.push($(selected[i]).find('.total_'+i).val())

        }
        getRank(total_array, 'position_')
    }

    //function that ranks the students in subject and displays the rank
    function getRank($values, pre_fix){
        //var $values = [1,4,6,8,4,6]
        var $ordered_values = $values;
        $ordered_values.sort(function(a, b){return b-a});

        for(i in $values){
            for(j in $ordered_values){
                if ($values[i] === $ordered_values[j]) {
                    i = j;
                    break;
                }
            }
            var rank =  parseInt(i)+1;
            //alert(ordinal_suffix_of(rank));

            var selected = $("."+pre_fix+$values[i])
            for(var c = 0; c < selected.length; c++){
                if(pre_fix === "position_"){
                    $(selected[c]).val(ordinal_suffix_of(rank))
                }else{
                    $(selected[c]).find("input").val(ordinal_suffix_of(rank))
                }
            }

        }

    }

    function ordinal_suffix_of(i) {
        var j = i % 10,
            k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }
        return i + "th";
    }

    function getStudentRank(grades_array) {
        var selected = $('.result-values-hold tr');

        for(var i = 0; i < selected.length; i++){

            let total_score = $(selected[i]).find('.total_'+i).val();

            gradeStudent(grades_array, total_score, 'grade_'+i, 'remark_'+i)
        }
    }

    function range(start, stop, step){
        var a = [start], b = start;
        while(b < stop){b += (step || 1); a.push(b)}
        return a;
    }

    //function that grades the students in subject and displays the rank
    function gradeStudent(grades_array = [], total_score, grade_class, remark_class){

        for(i in grades_array.start_limit){

            if(checkIfInArray(Math.round(total_score), range(parseFloat(grades_array.start_limit[i]), parseFloat(grades_array.end_limit[i], 1)))  != -1 ){

                $('.'+grade_class).val(grades_array.grades[i]);
                $('.'+remark_class).val(grades_array.remark[i]);
                break;
            }


        }

    }

    function targetedInputField(values, loopId, num) {
        var select_i = parseFloat(values[loopId].length) - parseFloat(num);
        return select_i;
    }


</script>
