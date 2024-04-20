object fmFindDialog: TForm
  Left = 10
  Top = 10
  BorderStyle = bsSizeToolWin
  Caption = '{Find}'
  ClientHeight = 124
  ClientWidth = 472
  Color = clWhite
  Constraints.MaxHeight = 124
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -13
  Font.Name = 'Segoe UI'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  FormStyle = fsStayOnTop
  DesignSize = (
    472
    124)
  PixelsPerInch = 96
  TextHeight = 17
  object label1: TLabel
    Left = 16
    Top = 16
    Width = 80
    Height = 25
    Alignment = taRightJustify
    AutoSize = False
    Caption = #1053#1072#1081#1090#1080':'
    Layout = tlCenter
  end
  object label2: TLabel
    Left = 16
    Top = 48
    Width = 80
    Height = 25
    Alignment = taRightJustify
    AutoSize = False
    Caption = #1047#1072#1084#1077#1085#1080#1090#1100' '#1085#1072':'
    Layout = tlCenter
  end
  object next: TButton
    Left = 347
    Top = 16
    Width = 112
    Height = 32
    Anchors = [akTop, akRight]
    Caption = #1048#1089#1082#1072#1090#1100' >>'
    TabOrder = 3
  end
  object replace: TButton
    Left = 347
    Top = 56
    Width = 112
    Height = 24
    Anchors = [akTop, akRight]
    Caption = #1047#1072#1084#1077#1085#1080#1090#1100
    TabOrder = 4
  end
  object replaceAll: TButton
    Left = 347
    Top = 88
    Width = 112
    Height = 24
    Anchors = [akTop, akRight]
    Caption = #1047#1072#1084#1077#1085#1080#1090#1100' '#1074#1089#1077
    TabOrder = 5
  end
  object findText: TEdit
    Left = 104
    Top = 16
    Width = 232
    Height = 25
    Anchors = [akLeft, akTop, akRight]
    TabOrder = 0
    Alignment = taLeftJustify
    ColorOnEnter = clNone
    FontColorOnEnter = clNone
    TabOnEnter = False
    MarginLeft = 0
    MarginRight = 0
  end
  object replaceText: TEdit
    Left = 104
    Top = 48
    Width = 232
    Height = 25
    Anchors = [akLeft, akTop, akRight]
    TabOrder = 1
    Alignment = taLeftJustify
    ColorOnEnter = clNone
    FontColorOnEnter = clNone
    TabOnEnter = False
    MarginLeft = 0
    MarginRight = 0
  end
  object reg: TCheckBox
    Left = 16
    Top = 88
    Width = 128
    Height = 24
    Caption = #1059#1095#1080#1090#1099#1074#1072#1090#1100' '#1088#1077#1075#1080#1089#1090#1088
    TabOrder = 2
  end
  object message: TStatusBar
    Left = 0
    Top = 136
    Width = 424
    Height = 24
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clBtnText
    Font.Height = -13
    Font.Name = 'Segoe UI'
    Font.Style = []
    Panels = <>
    SimplePanel = True
    UseSystemFont = False
    Visible = False
    ExplicitLeft = 112
    ExplicitTop = 128
    ExplicitWidth = 216
  end
end
