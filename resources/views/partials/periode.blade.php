        @csrf
        <label for="" class="p_label me-5 pt-2">Période de : </label>
        <div class="me-5">
            <input type="date" class="bg-transparent form-control rounded-0" style=" border:none; border-bottom:2px solid blueviolet;" name="debut_periode" value="@php if(isset($_POST['name'])){echo $_POST['name'];}@endphp" required id="" placeholder="Search driver">
        </div>
        <label for="" class="p_label me-5 pt-2">à</label>
        <div class="d-flex me-5">
            <input type="date" class="bg-transparent form-control rounded-0" style=" border:none; border-bottom:2px solid blueviolet;" name="fin_periode" value="@php if(isset($_POST['name'])){echo $_POST['name'];}@endphp" required id="" placeholder="Search driver">
            <div style="border-bottom: 2px solid blueviolet;">
                <button type="submit" class="border-0 rounded-0" style="background-color:blueviolet;width:40px; height:36px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 30 30" width="25px" height="30px">
                        <g id="surface8234173">
                            <path style=" stroke:none;fill-rule:nonzero;fill:white;fill-opacity:1;" d="M 13 3 C 7.488281 3 3 7.488281 3 13 C 3 18.511719 7.488281 23 13 23 C 15.398438 23 17.597656 22.148438 19.324219 20.734375 L 25.292969 26.707031 C 25.542969 26.96875 25.917969 27.074219 26.265625 26.980469 C 26.617188 26.890625 26.890625 26.617188 26.980469 26.265625 C 27.074219 25.917969 26.96875 25.542969 26.707031 25.292969 L 20.734375 19.320312 C 22.148438 17.597656 23 15.398438 23 13 C 23 7.488281 18.511719 3 13 3 Z M 13 5 C 17.429688 5 21 8.570312 21 13 C 21 17.429688 17.429688 21 13 21 C 8.570312 21 5 17.429688 5 13 C 5 8.570312 8.570312 5 13 5 Z M 13 5 " />
                        </g>
                    </svg>
                </button>
            </div>
        </div>