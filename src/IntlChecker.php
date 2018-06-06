<?php
/* ===========================================================================
 * Copyright 2014-2018 The Opis Project
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ============================================================================ */

namespace Opis\Intl;

class IntlChecker
{
    /** @var null|bool */
    protected static $hasExtension = null;

    /**
     * @return bool
     */
    public static function extensionExists(): bool
    {
        if (self::$hasExtension === null) {
            self::$hasExtension = extension_loaded('intl');
        }

        return self::$hasExtension;
    }
}