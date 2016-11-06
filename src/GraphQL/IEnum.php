<?php declare(strict_types = 1);

namespace Adeira\Connector\GraphQL;

/**
 * Enumeration types are a special kind of scalar that is restricted to a particular set of allowed values. This allows
 * you to:
 *
 *  - Validate that any arguments of this type are one of the allowed values
 *  - Communicate through the type system that a field will always be one of a finite set of values
 *
 * Here's what an enum definition might look like in the GraphQL schema language:
 *
 * enum Episode {
 *     NEWHOPE
 *     EMPIRE
 *     JEDI
 * }
 *
 * This means that wherever we use the type Episode in our schema, we expect it to be exactly one of 'NEWHOPE',
 * 'EMPIRE', or 'JEDI'.
 *
 * @see http://graphql.org/learn/schema/#enumeration-types
 */
class IEnum
{

	//TODO

}
