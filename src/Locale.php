<?php
/* ===========================================================================
 * Copyright 2014-2017 The Opis Project
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

use Locale as IntlLocale,
    ResourceBundle as IntlResourceBundle;

class Locale implements ILocale
{

    /** Default locale string for system */
    const SYSTEM_LOCALE = 'en__SYSTEM';

    /** @see https://en.wikipedia.org/wiki/Right-to-left */
    const RTL_SCRIPTS = [
        'Arab', 'Aran',
        'Hebr', 'Samr',
        'Syrc', 'Syrn', 'Syrj', 'Syre',
        'Mand',
        'Thaa',
        'Mend',
        'Nkoo',
        'Adlm',
    ];

    /** @var string */
    protected $id;

    /** @var string */
    protected $language;

    /** @var null|string */
    protected $script;

    /** @var null|string */
    protected $region;

    /** @var bool */
    protected $rtl;

    /**
     * Locale constructor.
     * @param string $id Canonical name
     * @param string $language Two letters code
     * @param string|null $script Script name ISO 15924
     * @param string|null $region Two letters code
     * @param bool $rtl
     */
    public function __construct(string $id, string $language, string $script = null, string $region = null, bool $rtl = false)
    {
        $this->id = $id;
        $this->language = $language;
        $this->script = $script;
        $this->region = $region;
        $this->rtl = $rtl;
    }

    /**
     * @inheritdoc
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function language(): string
    {
        return $this->language;
    }

    /**
     * @inheritdoc
     */
    public function script()
    {
        return $this->script;
    }

    /**
     * @inheritdoc
     */
    public function region()
    {
        return $this->region;
    }

    /**
     * @inheritdoc
     */
    public function rtl(): bool
    {
        return $this->rtl;
    }

    /**
     * @param string $locale
     * @return Locale
     */
    public static function create(string $locale = null): self
    {
        if ($locale === null) {
            $locale = IntlLocale::getDefault();
            if (!$locale) {
                $locale = static::SYSTEM_LOCALE;
            }
        }
        $locale = static::canonicalize($locale);
        $p = IntlLocale::parseLocale($locale);

        return new static(
            $locale,
            $p['language'] ?? 'en',
            $p['script'] ?? null,
            $p['region'] ?? null,
            static::isScriptRTL($p['script'] ?? null)
        );
    }

    /**
     * @param array $locale
     * @return Locale
     */
    public static function fromArray(array $locale): self
    {
        $name = $locale['id'] ?? $locale['name'] ?? null;
        if (!$name && isset($locale['language'])) {
            $name = $locale['language'];
            unset($locale['language']);
            if (isset($locale['script'])) {
                $name .= '_' . $locale['script'];
                unset($locale['script']);
            }
            if (isset($locale['region'])) {
                $name .= '_' . $locale['region'];
                unset($locale['region']);
            }
        } else {
            $name = IntlLocale::getDefault();
        }
        if (!$name) {
            $locale = static::SYSTEM_LOCALE;
        }
        $name = static::canonicalize($name);
        $locale = array_filter($locale, function ($value) {
            return $value !== null;
        });
        $locale += IntlLocale::parseLocale($name);

        return new static(
            $name,
            $locale['language'] ?? 'en',
            $locale['script'] ?? null,
            $locale['region'] ?? null,
            $locale['rtl'] ?? static::isRTL($name)
        );
    }

    /**
     * @param string $locale
     * @return string
     */
    public static function canonicalize(string $locale): string
    {
        return IntlLocale::canonicalize($locale);
    }

    /**
     * @param string $locale
     * @return bool
     */
    public static function isRTL(string $locale): bool
    {
        return static::isScriptRTL(IntlLocale::getScript($locale));
    }

    /**
     * Check if the script is RTL
     * @param string|null $script
     * @return bool
     */
    public static function isScriptRTL(string $script = null): bool
    {
        if ($script === null) {
            return false;
        }

        return in_array($script, static::RTL_SCRIPTS);
    }

    /**
     * @return string[]
     */
    public static function systemLocales(): array
    {
        $locales = IntlResourceBundle::getLocales('');
        array_unshift($locales, static::SYSTEM_LOCALE);

        return $locales;
    }

    /**
     * @param string $locale
     * @param string|null $in_language
     * @return string
     */
    public static function getDisplayLanguage(string $locale, string $in_language = null): string
    {
        return IntlLocale::getDisplayLanguage($locale, $in_language ?? static::SYSTEM_LOCALE);
    }

    /**
     * @param string $locale
     * @param string|null $in_language
     * @return string
     */
    public static function getDisplayName(string $locale, string $in_language = null): string
    {
        return IntlLocale::getDisplayName($locale, $in_language ?? static::SYSTEM_LOCALE);
    }
}