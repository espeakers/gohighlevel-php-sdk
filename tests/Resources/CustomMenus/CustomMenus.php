<?php

use MusheAbdulHakim\GoHighLevel\Resources\CustomMenus\CustomMenu;
use MusheAbdulHakim\GoHighLevel\Contracts\TransporterContract;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Payload;
use MusheAbdulHakim\GoHighLevel\ValueObjects\Transporter\Response;

beforeEach(function () {
    $this->transporter = Mockery::mock(TransporterContract::class);
    $this->custom_menus = new CustomMenu($this->transporter);
});

it('can list custom menus', function () {
    $locationId = 'loc_1';
    $expectedParams = ['locationId' => $locationId];

    $mockApiResponse = ['customMenus' => []];
    $mockResponse = Response::from($mockApiResponse);

    $expectedPayload = Payload::get('custom-menus/', $expectedParams);

    $this->transporter
        ->shouldReceive('requestObject')
        ->once()
        ->with(Mockery::on(function (Payload $payload) use ($expectedPayload) {
            return $payload == $expectedPayload;
        }))
        ->andReturn($mockResponse);

    $result = $this->custom_menus->list($locationId);
    expect($result)->toBe($mockApiResponse);
});

it('can get custom menu', function () {
    $customMenuId = 'menu_1';
    $expectedParams = [];

    $mockApiResponse = ['customMenus' => []];
    $mockResponse = Response::from($mockApiResponse);

    $expectedPayload = Payload::get("custom-menus/{$customMenuId}", $expectedParams);

    $this->transporter
        ->shouldReceive('requestObject')
        ->once()
        ->with(Mockery::on(function (Payload $payload) use ($expectedPayload) {
            return $payload == $expectedPayload;
        }))
        ->andReturn($mockResponse);

    $result = $this->custom_menus->get($customMenuId);
    expect($result)->toBe($mockApiResponse);
});

it('can update custom menu', function () {
    $customMenuId = 'menu_1';
    $params = ['limit' => 10];
    $expectedParams = $params;

    $mockApiResponse = ['customMenus' => []];
    $mockResponse = Response::from($mockApiResponse);

    $expectedPayload = Payload::put("custom-menus/{$customMenuId}", $expectedParams);

    $this->transporter
        ->shouldReceive('requestObject')
        ->once()
        ->with(Mockery::on(function (Payload $payload) use ($expectedPayload) {
            return $payload == $expectedPayload;
        }))
        ->andReturn($mockResponse);

    $result = $this->custom_menus->update($customMenuId, $params);
    expect($result)->toBe($mockApiResponse);
});

it('can delete custom menu', function () {
    $customMenuId = 'menu_1';

    $mockApiResponse = ['customMenus' => []];
    $mockResponse = Response::from($mockApiResponse);

    $expectedPayload = Payload::delete("custom-menus/", $customMenuId);

    $this->transporter
        ->shouldReceive('requestObject')
        ->once()
        ->with(Mockery::on(function (Payload $payload) use ($expectedPayload) {
            return $payload == $expectedPayload;
        }))
        ->andReturn($mockResponse);

    $result = $this->custom_menus->delete($customMenuId);
    expect($result)->toBe($mockApiResponse);
});

it('can create custom menu', function () {
    $params = [
        'title' => 'Menu',
        'url' => 'https://custom-menus.com/',
        'showOnLocation' => true,
        'showToAllLocations' => true,
        'openMode' => 'iframe',
        'userRole' => 'all'

    ];
    $expectedParams = $params;
    $mockApiResponse = ['customMenus' => []];
    $mockResponse = Response::from($mockApiResponse);

    $expectedPayload = Payload::post("custom-menus/", $params);

    $this->transporter
        ->shouldReceive('requestObject')
        ->once()
        ->with(Mockery::on(function (Payload $payload) use ($expectedPayload) {
            return $payload == $expectedPayload;
        }))
        ->andReturn($mockResponse);

    $result = $this->custom_menus->create($params);
    expect($result)->toBe($mockApiResponse);
});
