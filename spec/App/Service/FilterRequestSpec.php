<?php

namespace spec\App\Service;

use App\Service\FilterRequest;
use PhpSpec\ObjectBehavior;

class FilterRequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(FilterRequest::class);
    }

    function it_matches_int()
    {
        $this::toInt('123')->shouldBe(123);
        $this::toInt('123.45')->shouldBe(null);
        $this::toInt('a123')->shouldBe(null);
    }

    function it_matches_array()
    {
        $this::inArray('test', ['test'])->shouldBe('test');
        $this::inArray('difficulty', ['user', 'score', 'difficulty'])->shouldBe('difficulty');
        $this::inArray('difficu1ty', ['user', 'score', 'difficulty'])->shouldBe(null);
    }
}
