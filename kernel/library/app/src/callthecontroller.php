                $reflection = new \ReflectionMethod(self::$controller, self::$function);
                if (!$reflection->isPublic()) {
                    new CreateError('thisMethodIsPrivate');
                }