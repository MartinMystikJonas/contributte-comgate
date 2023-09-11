<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Entity;

use Brick\Money\Money;
use Contributte\Comgate\Entity\Codes\CountryCode;
use Contributte\Comgate\Entity\Payment;
use Contributte\Comgate\Entity\RecurringPayment;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

test(function (): void {
	$payment = RecurringPayment::of(
		'123-ABC-123',
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
		CountryCode::CZ
	);
	Assert::equal([
		'price' => 5000,
		'curr' => 'CZK',
		'label' => 'Test item',
		'refId' => 'order101',
		'email' => 'dev@contributte.org',
		'country' => 'CZ',
		'account' => null,
		'name' => null,
		'prepareOnly' => 'true',
		'initRecurringId' => '123-ABC-123',
	], $payment->toArray());
});

test(function (): void {
	$payment = Payment::of(
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setName('item101');
	Assert::equal('item101', $payment->toArray()['name']);
});

test(function (): void {
	$payment = RecurringPayment::of(
		'123-ABC-123',
		Money::of(50, 'CZK'),
		'Test item',
		'order101',
		'dev@contributte.org',
	);
	$payment->setAccount('acc1');
	Assert::equal('acc1', $payment->toArray()['account']);
});
