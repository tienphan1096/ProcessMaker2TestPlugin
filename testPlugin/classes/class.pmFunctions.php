<?php
/**
 * class.testPlugin.pmFunctions.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.
 * *
 */

////////////////////////////////////////////////////
// testPlugin PM Functions
//
// Copyright (C) 2007 COLOSA
//
// License: LGPL, see LICENSE
////////////////////////////////////////////////////

function testPlugin_getMyCurrentDate()
{
	return G::CurDate('Y-m-d');
}

function testPlugin_getMyCurrentTime()
{
	return G::CurDate('H:i:s');
}
