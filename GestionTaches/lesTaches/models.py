from datetime import date, timedelta
from pydoc import describe
from pyexpat import model
from time import clock_getres
from turtle import color
from django.db import models

# Create your models here.

class Task(models.Model):
    name = models.CharField(max_length=250)
    description = models.TextField()
    due_date = models.DateField(null=True)
    creation_date = models.DateField(auto_now_add=True)
    closed = models.BooleanField(default=False)


    def __str__(self):
        return self.name
    def colored_due_date(self):
        if self.due_date - timedelta(days=7) > date.today():
            color = "green"
        elif self.due_date < date.today():
            color="red"
        else:
            color = "orange"
        
        return format_html("<span style=color:%s>%s</span>"%(color,due_date))
