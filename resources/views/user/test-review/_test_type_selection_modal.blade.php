<div class="modal" id="modal-test_type_selection" tabindex="-1" aria-labelledby="modal-test_type_selection"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title set_category_title">
                        Choose Difficulty
                    </h3>
                </div>
                <div class="">
                    <?php $helper = new Helper();
                    $ratings = $helper->getAllDifficultyRating();
                    ?>
                    <div>
                        <div class="p-5">
                            @if (isset($ratings))
                                <div class="mb-5">
                                    @foreach ($ratings['ratings'] as $rating)
                                        <div class="diff_rating mb-2">
                                            <input type="checkbox" name="item" id="item-{{ $loop->iteration }}"
                                                value="{{ $rating['id'] }}" class="selected-item">
                                            <label for="item-{{ $loop->iteration }}"
                                                class="ms-2">{{ $rating['title'] }}</label><span
                                                class="ms-2 diff_{{ $rating['id'] }}"></span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mb-2">
                                    <input type="radio" name="questions_type" id="all_unanswered"
                                        value="all_unanswered" class="questions_type">
                                    <label for="all_unanswered" class="ms-2">All
                                        Unanswered <span class="ms-2 diff_5"></label>
                                </div>
                                <div class="mb-2">
                                    <input type="radio" name="questions_type" id="all_questions" value="all_questions"
                                        class="questions_type" checked>
                                    <label for="all_questions" class="ms-2">All
                                        Questions <span class="ms-2 diff_6"></label>
                                    <input type="number" name="no_of_questions" id="no_of_questions"
                                        placeholder="Please input number of questions to be generated"
                                        class="no_of_questions" checked>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="block-content block-content-full text-end bg-body">
                <button type="button" class="btn btn-sm block-header-default text-white"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" id="generate-quiz"
                    class="btn btn-primary fs-xs fw-semibold generate_custom_quiz_two" style="">Generate
                    Quiz</button>
            </div>
        </div>
    </div>
</div>
</div>
