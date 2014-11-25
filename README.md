Freeform Count
========================

{exp:freeform:count} was removed in Freeform 4: http://www.solspace.com/docs/freeform/upgrade_3.x-4.x/

This is not a full reimplementation of the functionality, but it will allow you to do a simple count by form_id, form_label (or collection) like this:

```
{exp:freeform_count collection="collection_name"}
	There are {count} submissions.
{/exp:freeform_count}
```

The {count} variable name is not the best ever but I've kept it to ease migration.
