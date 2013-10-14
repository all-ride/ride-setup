<?php

namespace pallo\setup;

use \Composer\Installer\LibraryInstaller;
use \Composer\Package\PackageInterface;
use \Composer\Plugin\PluginInterface;
use \Composer\Repository\InstalledRepositoryInterface;

/**
 * Setup hooks for the Composer dependency manager
 */
class ComposerInstaller extends LibraryInstaller implements PluginInterface {

    /**
     * Type of packages to handle
     * @var string
     */
    const TYPE = 'pallo-setup';

    /**
     * Activates the installer
     * @param Composer $composer
     * @param IOInterface $io
     */
    public function activate(Composer $composer, IOInterface $io) {
        $installer = new self($io, $composer, self::TYPE);

        $composer->getInstallationManager()->addInstaller($installer);
    }

    /**
     * Decides if the installer supports the given type
     *
     * @param  string $packageType
     * @return bool
     */
    public function supports($packageType) {
        return $packageType == self::TYPE;
    }

    /**
     * Installs specific package.
     *
     * @param InstalledRepositoryInterface $repo    repository in which to check
     * @param PackageInterface             $package package instance
     */
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package) {
        parent::install($repo, $package);

        $script = 'vendor/' . $package->getPrettyName() . '/src/install.php';
        if (file_exists($script)) {
            include($script);
        }
    }

    /**
     * Updates specific package.
     *
     * @param InstalledRepositoryInterface $repo    repository in which to check
     * @param PackageInterface             $initial already installed package version
     * @param PackageInterface             $target  updated version
     *
     * @throws InvalidArgumentException if $from package is not installed
     */
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target) {
        parent::update($repo, $initial, $target);

        $script = 'vendor/' . $package->getPrettyName() . '/src/update.php';
        if (file_exists($script)) {
            include($script);
        }
    }

    /**
     * Uninstalls specific package.
     *
     * @param InstalledRepositoryInterface $repo    repository in which to check
     * @param PackageInterface             $package package instance
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package) {
        parent::uninstall($repo, $package);

        $script = 'vendor/' . $package->getPrettyName() . '/src/uninstall.php';
        if (file_exists($script)) {
            include($script);
        }
    }

}