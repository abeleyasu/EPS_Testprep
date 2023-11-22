@foreach($practice_test_sections as $key => $sections)
    @php
        $questions = \DB::table('practice_questions')->where(['practice_test_sections_id' => $sections->id])->get();
    @endphp
    @if(count($questions) > 0)
        @foreach($questions as $question)
            @php
                $answers = \DB::table('scores')->where([
                    'test_id' => $test_id,
                    'question_id' => $question->id,
                    'section_id' => $sections->id
                ])->first();
            @endphp
            <tr id="score_{{ $sections->id }}_{{ $question->id }}" data-section_id="{{ $sections->id }}" data-question_id="{{ $question->id }}" data-section_type="{{ $sections->practice_test_type }}" data-test_id="{{ $test_id }}">
                <td>
                    <input
                        type="number"
                        placeholder="Actual Score"
                        id="actualScore_{{ $question->id }}"
                        name="actualScore"
                        class="form-control"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        @if($answers)
                            value="{{ $answers->actual_score }}"
                        @else
                            value=""
                        @endif
                        
                    />
                </td>
                <td>
                    <input
                        type="number"
                        placeholder="Converted Score"
                        id="convertedScore_{{ $question->id }}"
                        name="convertedScore"
                        class="form-control"
                        onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                        @if($answers)
                            value="{{ $answers->converted_score }}"
                        @else
                            value=""
                        @endif
                    />
                </td>
            </tr>
        @endforeach
    @endif

    @if(count($practice_test_sections) > 0)
        @if($key == 0)
            @if (in_array($sections->practice_test_type, ['Reading_And_Writing','Math']))
                @php
                    $answerZero = \DB::table('scores')->where([
                        'test_id' => $test_id,
                        'question_id' => 0,
                        'section_id' => $sections->id
                    ])->first();
                @endphp
                <tr id="score_{{ $sections->id }}_0" data-section_id="{{ $sections->id }}" data-question_id="0" data-section_type="{{ $sections->practice_test_type }}" data-test_id="{{ $test_id }}">
                    <td>
                        <input
                            type="number"
                            placeholder="Actual Score"
                            id="actualScore_0"
                            name="actualScore"
                            class="form-control"
                            onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                            @if($answerZero)
                                value="{{ $answerZero->actual_score }}"
                            @else
                                value=""
                            @endif
                        />
                    </td>
                    <td>
                        <input
                            type="number"
                            placeholder="Converted Score"
                            id="convertedScore_0"
                            name="convertedScore"
                            class="form-control"
                            onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))"
                            @if($answerZero)
                                value="{{ $answerZero->converted_score }}"
                            @else
                                value=""
                            @endif
                        />
                    </td>
                </tr>
            @endif
        @endif
    @endif

@endforeach
