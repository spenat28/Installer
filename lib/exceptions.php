<?php

namespace Installer;

/**
 * Hierarchie výjimek
 * -----------------------------------------------------------------------------
 *
 * - Exception
 *     - RuntimeException = důležitý je typ výjimky pro přesné zachytávání; nelze jí předejít
 *         - Installer\InvalidStateException
 *         - Installer\DuplicateEntryException
 *         - Installer\IOException
 *             - Installer\FileNotFoundException
 *             - Installer\DirectoryNotFoundException
 *     - LogicException = chyba v kódu, který volá metodu, která tuto výjimku vyhodila; lze jí předejít
 *         - InvalidArgumentException
 *             - Installer\InvalidArgumentException
 *                 - Installer\ArgumentOutOfRangeException
 *         - Installer\NotImplementedException
 *         - Installer\NotSupportedException
 *             - Installer\DeprecatedException
 *         - Installer\StaticClassException
 *
 */


// === Runtime exceptions ======================================================

/**
 * Výjimka vyhazovaná v případě, že volání metody je vzhledem k stavu objektu
 * neplatné (např. některé parametry ještě nejsou nastaveny) nebo je proběhlo
 * ve špatný nebo nevhodný čas.
 *
 * @codeCoverageIgnore
 */
class InvalidStateException extends \RuntimeException
{

}



/**
 * Výjimky vyhazovaná v případě, že se nepodaří zapsat záznam (obvykle) do DB
 * kvůli unikátnímu indexu.
 *
 * @codeCoverageIgnore
 */
class DuplicateEntryException extends \RuntimeException
{

}



/**
 * Výjimky vyhazovaná v případě, že se dojdek IO chybě.
 *
 * @codeCoverageIgnore.
 */
class IOException extends \RuntimeException
{

}



/**
 * Výjimka vyhazovaná při neexistenci souboru.
 *
 * @codeCoverageIgnore
 */
class FileNotFoundException extends IOException
{

}



/**
 * Výjimka vyhazovaná při neexistenci složky.
 *
 * @codeCoverageIgnore
 */
class DirectoryNotFoundException extends IOException
{

}



// === Logic exceptions ========================================================

/**
 * Výjimka vyhazovaná v případě, že je metodě předán neplatný argument.
 * (Např. předání jiného než očekávaného typu.)
 *
 * @codeCoverageIgnore
 */
class InvalidArgumentException extends \InvalidArgumentException
{

}



/**
 * Výjimka vyhazovaná v případě, že je metodě předán argument, který nespadá
 * do množiny povolených hodnot.
 *
 * @codeCoverageIgnore
 */
class ArgumentOutOfRangeException extends InvalidArgumentException
{

}



/**
 * Výjimka vyhazovaná v případě, že volaná metoda nebo její část není ještě
 * implementovaná.
 *
 * @codeCoverageIgnore
 */
class NotImplementedException extends \LogicException
{

}



/**
 * Výjimka vyhazovaná v případě, že požadovaná činnost není podporovaná.
 *
 * @codeCoverageIgnore
 */
class NotSupportedException extends \LogicException
{

}



/**
 * Výjimka vyhazovaná v případě, že volaná metoda nebo způsob jejího volání
 * je zastaralý.
 *
 * @codeCoverageIgnore
 */
class DeprecatedException extends NotSupportedException
{

}



/**
 * Výjimka vyhazovaná pří pokusu o vytvoření instance statické třídy.
 *
 * @codeCoverageIgnore
 */
class StaticClassException extends \LogicException
{

}
