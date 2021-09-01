<?php

namespace ride\setup;

use \Composer\Installer\LibraryInstaller;
use \Composer\Package\PackageInterface;
use \Composer\Repository\InstalledRepositoryInterface;
use React\Promise\PromiseInterface;

/**
 * Setup hooks for the Composer dependency manager
 */
class ComposerInstaller extends LibraryInstaller {

    /**
     * Type of packages to handle
     * @var string
     */
    const TYPE = 'ride-setup';

    /**
     * Decides if the installer supports the given type
     *
     * @param string $packageType
     * @return bool
     */
    public function supports($packageType) {
        return $packageType == self::TYPE;
    }

    /**
     * Installs specific package.
     *
     * @param InstalledRepositoryInterface $repo repository in which to check
     * @param PackageInterface $package package instance
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package) {
        $promise = parent::install($repo, $package);

        $outputStatus = function () use ($package) {
            $script = 'vendor/' . $package->getPrettyName() . '/src/install.php';
            if (file_exists($script)) {
                include($script);
            }
        };

        //Composer V2 might return a promise here
        if ($promise instanceof PromiseInterface) {
            return $promise->then($outputStatus);
        }

        $outputStatus();
    }

    /**
     * Updates specific package.
     *
     * @param InstalledRepositoryInterface $repo repository in which to check
     * @param PackageInterface $initial already installed package version
     * @param PackageInterface $target updated version
     *
     * @throws InvalidArgumentException if $from package is not installed
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target) {
        $promise = parent::update($repo, $initial, $target);

        $outputStatus = function () use ($target) {
            $script = 'vendor/' . $target->getPrettyName() . '/src/update.php';
            if (file_exists($script)) {
                include($script);
            }
        };

        // Composer v2 might return a promise here
        if ($promise instanceof PromiseInterface) {
            return $promise->then($outputStatus);
        }

        $outputStatus();
    }

    /**
     * Uninstalls specific package.
     *
     * @param InstalledRepositoryInterface $repo repository in which to check
     * @param PackageInterface $package package instance
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package) {
        $promise = parent::uninstall($repo, $package);

        $outputStatus = function () use ($package) {
            $script = 'vendor/' . $package->getPrettyName() . '/src/uninstall.php';
            if (file_exists($script)) {
                include($script);
            }
        };

        // Composer v2 might return a promise here
        if ($promise instanceof PromiseInterface) {
            return $promise->then($outputStatus);
        }

        $outputStatus();
    }

}