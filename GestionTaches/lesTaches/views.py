from contextvars import Context
from itertools import tee
from re import template
from django.shortcuts import render
from lesTaches.models import Task

# Create your views here.

from django.http import HttpResponse
def home(request, param):
    return HttpResponse('Bonjour a tous')

def task_listing(request):
    objets = Task.objects.all().order_by('due_date')
    return render(request, template_name='list.html', context={'objets':objets})
def task_listing2(request):
    objets = Task.objects.all().order_by('-due_date')
    return render(request, template_name='list.html', context={'taches':objets})
    