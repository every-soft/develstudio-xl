object fmListEditor: TfmListEditor
  Left = 10
  Top = 10
  BorderStyle = bsSizeToolWin
  Caption = '{array_editor}'
  ClientHeight = 376
  ClientWidth = 336
  Color = clBtnFace
  Constraints.MinHeight = 376
  Constraints.MinWidth = 336
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -12
  Font.Name = 'Segoe UI'
  Font.Style = []
  OldCreateOrder = False
  DesignSize = (
    336
    376)
  PixelsPerInch = 96
  TextHeight = 13
  object BitBtn1: TBitBtn
    Left = 246
    Top = 344
    Width = 83
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 0
    NumGlyphs = 2
    ExplicitLeft = 267
    ExplicitTop = 165
  end
  object BitBtn2: TBitBtn
    Left = 156
    Top = 344
    Width = 83
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 1
    ExplicitLeft = 177
    ExplicitTop = 165
  end
  object checkList1: TCheckListBox
    Left = 8
    Top = 8
    Width = 320
    Height = 328
    HelpType = htKeyword
    HelpKeyword = 
      'AAAAAhQCEQVDTEFTUxENVENoZWNrTGlzdEJveBEGUEFSQU1TFAYRCGF2aXNpYmxl' +
      'BREIYWVuYWJsZWQFEQF3DEBiAAAAAAAAEQFoDEBiAAAAAAAAEQZwYXJlbnQXBVRG' +
      'b3JtFAYRCmNsYXNzX25hbWUOCBEPACoAX2NvbnN0cmFpbnRzFxBUU2l6ZUNvbnN0' +
      'cmFpbnRzFAMOCQ4LEQRzZWxmCgwsl6ARCAAqAHByb3BzFAARBwAqAGljb24AEQgA' +
      'KgBfZm9udAAODAoCW6tQDg0UAg4DBREKcG9zaXRpb25leBEKcG9EZXNpZ25lZBEE' +
      'dGV4dA0='
    TabStop = False
    Anchors = [akLeft, akTop, akRight, akBottom]
    ItemHeight = 15
    TabOrder = 2
    ExplicitWidth = 328
    ExplicitHeight = 296
  end
end
