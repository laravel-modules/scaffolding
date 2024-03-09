<?php

// Select All Routes.
Route::delete('delete', 'DeleteController@destroy')->name('delete.selected');
Route::delete('forceDelete', 'DeleteController@forceDelete')->name('forceDelete.selected');
Route::delete('restore', 'DeleteController@restore')->name('restore.selected');