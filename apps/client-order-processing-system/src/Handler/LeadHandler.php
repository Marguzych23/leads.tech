<?php


namespace Marguzych23\ClientOrderProcessingSystem\Handler;

use LeadGenerator\Lead;
use Marguzych23\ClientOrderProcessingSystem;

class LeadHandler implements HandlerInterface
{
    const ENABLE_LEAD_CATEGORY = [
        'Buy auto',
        'Buy house',
        //        'Get loan',
        'Cleaning',
        'Learning',
        'Car wash',
        //        'Repair smth',
        'Barbershop',
        'Pizza',
        'Car insurance',
        'Life insurance',
    ];
    private static ?ClientOrderProcessingSystem\Logger\LoggerInterface $logger = null;

    /**
     * @return ClientOrderProcessingSystem\Logger\LoggerInterface|null
     */
    protected static function getLogger(): ?ClientOrderProcessingSystem\Logger\LoggerInterface
    {
        if (self::$logger === null) {
            self::$logger = ClientOrderProcessingSystem\AppContainer::getObject(ClientOrderProcessingSystem\Logger\FileLogger::class);;
        }
        return self::$logger;
    }

    /**
     * @inheritDoc
     */
    public static function handle(object $object): void
    {
        try {
            if ($object instanceof Lead) {
                ClientOrderProcessingSystem\Data\DataContainer::set($object);
                if (ClientOrderProcessingSystem\Data\DataContainer::isContainerFull()) {
                    throw new \ArgumentCountError('Контейнер заполнен');
                }
            } else {
                throw new \InvalidArgumentException('Unsupported object: ' . get_class($object));
            }
        } catch (\ArgumentCountError $exception) {
            self::cleanContainer();
        } catch (\Throwable $exception) {
            self::getLogger()->error($exception->getMessage());
        }
    }

    /**
     *
     */
    public static function cleanContainer(): void
    {
//        по условию сон должен быть во время обработки lead))
        sleep(2);
        foreach (ClientOrderProcessingSystem\Data\DataContainer::getAll() as $lead) {
            try {
                if ($lead instanceof Lead) {
                    if (self::isHandleableCategory($lead->categoryName)) {
//                        можно сэкономить время, если использовать ключи в Data классах
                        $message = $lead->id . ' | ' . $lead->categoryName . ' | ' . date('c');
                        self::getLogger()->log(self::getLogger()::LOG, $message);
                    } else {
                        throw new \InvalidArgumentException('Unsupported category: ' . $lead->categoryName);
                    }
                } else {
                    throw new \InvalidArgumentException('Unsupported object: ' . get_class($lead));
                }
            } catch (\Throwable $exception) {
                self::getLogger()->error($exception->getMessage());
            }
        }

        ClientOrderProcessingSystem\Data\DataContainer::clean();
    }

    /**
     * @param string $category
     *
     * @return bool
     */
    public static function isHandleableCategory(string $category)
    {
        if (in_array($category, self::ENABLE_LEAD_CATEGORY)) {
            return true;
        }

        return false;
    }
}