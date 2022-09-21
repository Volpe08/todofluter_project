from django.contrib import admin
from lesTaches.models import Task

# Register your models here.
class TaskAdmin(admin.ModelAdmin):
    list_display=('name', 'creation_date','due_date')

admin.site.register(Task,TaskAdmin)
