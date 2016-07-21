<?php

namespace Rudolf\Component\Hooks;

/**
 * Hooks class. (WordPress plugin API fork).
 *
 * @author Mikołaj Pich <m.pich@outlook.com>
 *
 * @version 0.1
 */
class Filter
{
    /**
     * holds list of hooks.
     * 
     * 
     * @var array
     */
    public static $filters = array();

    /**
     * $mergedFilters.
     * 
     * @var array
     */
    public static $mergedFilters = array();

    /**
     * holds the name of the current filter.
     * 
     * @since 0.1
     * 
     * @var array
     */
    public static $currentFilter = array();

    /**
     * add Hooks a function or method to a specific filter action.
     * 
     * @since 0.1
     * 
     * @param string   $tag           The name of the filter to hook the $functionToAdd to.
     * @param callback $functionToAdd The name of the function to be called when 
     *                                the filter is applied.
     * @param int      $priority      optional. Used to specify the order in which the functions 
     *                                associated with a particular action are executed (default: 10). Lower numbers 
     *                                correspond with earlier execution, and functions with the same priority are 
     *                                executed in the order in which they were added to the action.
     * @param int      $accepted_args optional. The number of arguments the function accept (default 1).
     * 
     * @return bool true
     */
    public static function add($tag, $functionToAdd, $priority = 10, $accepted_args = 1)
    {
        $idx = self::buildUniqueID($tag, $functionToAdd, $priority);
        self::$filters[$tag][$priority][$idx] = array(
            'function' => $functionToAdd,
            'accepted_args' => $accepted_args,
        );
        unset(self::$mergedFilters[$tag]);

        return true;
    }

    /**
     * remove Removes a function from a specified filter hook.
     * 
     * @since 0.1
     *
     * @param string   $tag              The filter hook to which the function to be removed is hooked.
     * @param callback $functionToRemove The name of the function which should be removed.
     * @param int      $priority         optional. The priority of the function (default: 10).
     * @param int      $accepted_args    optional. The number of arguments the function accepts (default: 1).
     * 
     * @return bool Whether the function existed before it was removed.
     */
    public static function remove($tag, $functionToRemove, $priority = 10)
    {
        $functionToRemove = self::buildUniqueID($tag, $functionToRemove, $priority);

        $r = isset(self::$filters[$tag][$priority][$functionToRemove]);

        if (true === $r) {
            unset(self::$filters[$tag][$priority][$functionToRemove]);
            if (empty(self::$filters[$tag][$priority])) {
                unset(self::$filters[$tag][$priority]);
            }
            unset(self::$mergedFilters[$tag]);
        }

        return $r;
    }

    /**
     * removeAll Remove all of the hooks from a filter.
     * 
     * @since 0.1
     * 
     * @param string $tag      The filter to remove hooks from.
     * @param int    $priority The priority number to remove.
     * 
     * @return bool True when finished.
     */
    public static function removeAll($tag, $priority = false)
    {
        if (isset(self::$filters[$tag])) {
            if (false !== $priority && isset(self::$filters[$tag][$priority])) {
                unset(self::$filters[$tag][$priority]);
            } else {
                unset(self::$filters[$tag]);
            }
        }

        if (isset(self::$mergedFilters[$tag])) {
            unset(self::$mergedFilters[$tag]);
        }

        return true;
    }

    /**
     * has  Check if any filter has been registered for a hook.
     * 
     * @since 0.1
     * 
     * @param string   $tag             The name of the filter hook.
     * @param callback $functionToCheck optional.
     * 
     * @return mixed If $functionToCheck is omitted, returns boolean for whether the hook 
     *               has anything registered. When checking a specific function, the priority of that 
     *               hook is returned, or false if the function is not attached. When using the 
     *               $functionToCheck argument, this function may return a non-boolean value that 
     *               evaluates to false (e.g.) 0, so use the === operator for testing the return value.
     */
    public static function isHas($tag, $functionToCheck = false)
    {
        $has = !empty(self::$filters[$tag]);
        if (false === $functionToCheck || false == $has) {
            return $has;
        }

        if (!$idx = self::buildUniqueID($tag, $functionToCheck, false)) {
            return false;
        }

        foreach ((array) array_keys(self::$filters[$tag]) as $priority) {
            if (isset(self::$filters[$tag][$priority][$idx])) {
                return $priority;
            }
        }

        return false;
    }

    /**
     * apply Call the functions added to a filter hook.
     * 
     * @since 0.1
     * 
     * @param string $tag     The name of the filter hook.
     * @param mixed  $value   The value on which the filters hooked to <tt>$tag</tt> are applied on.
     * @param mixed  $var,... Additional variables passed to the functions hooked to <tt>$tag</tt>.
     * 
     * @return mixed The filtered value after all hooked functions are applied to it.
     */
    public static function apply($tag, $value)
    {
        $args = array();
        // Do 'all' actions first
        if (isset(self::$filters['all'])) {
            self::$currentFilter[] = $tag;
            $args = func_get_args();
            self::callAllHook($args);
        }

        if (!isset(self::$filters[$tag])) {
            if (isset(self::$filters['all'])) {
                array_pop(self::$currentFilter);
            }

            return $value;
        }

        if (!isset(self::$filters['all'])) {
            self::$currentFilter[] = $tag;
        }

        // Sort
        if (!isset(self::$mergedFilters[$tag])) {
            ksort(self::$filters[$tag]);
            self::$mergedFilters[ $tag ] = true;
        }

        reset(self::$filters[$tag]);

        if (empty($args)) {
            $args = func_get_args();
        }

        do {
            foreach ((array) current(self::$filters[$tag]) as $the_) {
                if (!is_null($the_['function'])) {
                    $args[1] = $value;
                    $value = call_user_func_array($the_['function'], array_slice($args, 1, (int) $the_['accepted_args']));
                }
            }
        } while (next(self::$filters[$tag]) !== false);

        array_pop(self::$currentFilter);

        return $value;
    }

    /**
     * applyRefArray Execute functions hooked on a specific filter hook, specifying arguments 
     * in an array.
     * 
     * @since 0.1
     * 
     * @param string $tag  The name of the filter hook.
     * @param array  $args The arguments supplied to the functions hooked to <tt>$tag</tt>
     * 
     * @return mixed The filtered value after all hooked functions are applied to it.
     */
    public static function applyRefArray($tag, $args)
    {
        // Do 'all' actions first
        if (isset(self::$filters['all'])) {
            self::$currentFilter[] = $tag;
            $all_args = func_get_args();
            self::callAllHook($all_args);
        }

        if (!isset(self::$filters[$tag])) {
            if (isset(self::$filters['all'])) {
                array_pop(self::$currentFilter);
            }

            return $args[0];
        }

        if (!isset(self::$filters['all'])) {
            self::$currentFilter[] = $tag;
        }

        // Sort
        if (!isset(self::$mergedFilters[$tag])) {
            ksort(self::$filters[$tag]);
            self::$mergedFilters[$tag] = true;
        }

        reset(self::$filters[$tag]);

        do {
            foreach ((array) current(self::$filters[$tag]) as $the_) {
                if (!is_null($the_['function'])) {
                    $args[0] = call_user_func_array($the_['function'], array_slice($args, 0, (int) $the_['accepted_args']));
                }
            }
        } while (next(self::$filters[$tag]) !== false);

        array_pop(self::$currentFilter);

        return $args[0];
    }

    /**
     * currentFilter Retrieve the name of the current filter or action.
     * 
     * @since 0.1
     * 
     * @return string Hook name of the current filter or action.
     */
    public static function currentFilter()
    {
        return end(self::$currentFilter);
    }

    /**
     * Retrieve the name of a filter currently being processed.
     *
     * The function currentFilter () only returns the most recent filter or action
     * being executed. did_action () returns true once the action is initially
     * processed. This function allows detection for any filter currently being
     * executed (despite not being the most recent filter to fire, in the case of
     * hooks called from hook callbacks) to be verified.
     *
     * @since 0.1.2
     * @see currentFilter ()
     * @see did_action ()
     *
     * @global array $wp_currentFilter Current filter.
     *
     * @param null|string $filter Optional. Filter to check. Defaults to null, which
     *                            checks if any filter is currently being run.
     *
     * @return bool Whether the filter is currently in the stack
     */
    public static function doing($filter = null)
    {
        if (null === $filter) {
            return !empty(self::$currentFilter);
        }

        return in_array($filter, self::$currentFilter);
    }

    /**
     * buildUniqueID Build Unique ID for storage and retrieval.
     * 
     * @param string   $tag      Used in counting how many hooks were applied
     * @param callback $function Used for creating unique id
     * @param int|bool $priority Used in counting how many hooks were applied. If === false and 
     *                           $function is an object reference, we return the unique id only if it already has one, false otherwise.
     * 
     * @return string|bool Unique ID for usage as array key or false if $priority === false and 
     *                     $function is an object reference, and it does not already have a unique id.
     */
    private static function buildUniqueID($tag, $function, $priority)
    {
        static $filter_id_count = 0;

        if (is_string($function)) {
            return $function;
        }

        if (is_object($function)) {
            // Closures are currently implemented as objects
            $function = array($function, '');
        } else {
            $function = (array) $function;
        }

        if (is_object($function[0])) {
            // Object Class Calling
            if (function_exists('spl_object_hash')) {
                return spl_object_hash($function[0]).$function[1];
            } else {
                $obj_idx = get_class($function[0]).$function[1];
                if (!isset($function[0]->filter_id)) {
                    if (false === $priority) {
                        return false;
                    }
                    $obj_idx .= isset(self::$filters[$tag][$priority]) ? count((array) self::$filters[$tag][$priority]) : $filter_id_count;
                    $function[0]->filter_id = $filter_id_count;
                    ++$filter_id_count;
                } else {
                    $obj_idx .= $function[0]->filter_id;
                }

                return $obj_idx;
            }
        } elseif (is_string($function[0])) {
            // Static Calling
            return $function[0].$function[1];
        }
    }
    /**
     * callAllHook.
     * 
     * @since 0.1
     * 
     * @param (array) $args [description]
     */
    public static function callAllHook($args)
    {
        reset(self::$filters['all']);

        do {
            foreach ((array) current(self::$filters['all']) as $the_) {
                if (!is_null($the_['function'])) {
                    call_user_func_array($the_['function'], $args);
                }
            }
        } while (next(self::$filters['all']) !== false);
    }
}
