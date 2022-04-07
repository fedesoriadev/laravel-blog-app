<?php

namespace Tests\Unit;

use App\Enums\AlertType;
use PHPUnit\Framework\TestCase;

class AlertTypeTest extends TestCase
{
    /** @test */
    public function it_provides_alert_types_cases(): void
    {
        $this->assertEquals('success', AlertType::SUCCESS->value);
        $this->assertEquals('danger', AlertType::DANGER->value);
        $this->assertEquals('warning', AlertType::WARNING->value);
        $this->assertEquals('info', AlertType::INFO->value);
    }

    /** @test */
    public function it_returns_html_classes_depending_alert_type(): void
    {
        $this->assertTrue(str_contains(AlertType::SUCCESS->containerClasses(), 'green'));
        $this->assertTrue(str_contains(AlertType::DANGER->containerClasses(), 'red'));
        $this->assertTrue(str_contains(AlertType::WARNING->containerClasses(), 'yellow'));
        $this->assertTrue(str_contains(AlertType::INFO->containerClasses(), 'blue'));

        $this->assertTrue(str_contains(AlertType::SUCCESS->closeButtonClasses(), 'green'));
        $this->assertTrue(str_contains(AlertType::DANGER->closeButtonClasses(), 'red'));
        $this->assertTrue(str_contains(AlertType::WARNING->closeButtonClasses(), 'yellow'));
        $this->assertTrue(str_contains(AlertType::INFO->closeButtonClasses(), 'blue'));
    }
}
